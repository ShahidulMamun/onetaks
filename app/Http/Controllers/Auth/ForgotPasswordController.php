<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\PasswordOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // ─── Step 1: Show "Enter Email" form ────────────────────────────────────
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    // ─── Step 2: Send OTP to email ──────────────────────────────────────────
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'এই email দিয়ে কোনো account নেই।',
        ]);

        // Rate limit: max 3 OTP per email per 10 minutes
        $key = 'otp-send:' . $request->email;
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "অনেক বার চেষ্টা করেছেন। {$seconds} সেকেন্ড পরে আবার চেষ্টা করুন।"
            ]);
        }
        RateLimiter::hit($key, 600); // 10 minutes decay

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete old OTPs for this email
        PasswordOtp::where('email', $request->email)->delete();

        // Create new OTP (expires in 10 minutes)
        PasswordOtp::create([
            'email'      => $request->email,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send email
        Mail::to($request->email)->send(new PasswordResetOtpMail($otp));

        // Store email in session for next steps
        session(['password_reset_email' => $request->email]);

        return redirect()->route('password.otp.form')
            ->with('success', 'OTP আপনার email এ পাঠানো হয়েছে। ১০ মিনিটের মধ্যে ব্যবহার করুন।');
    }

    // ─── Step 3: Show OTP verification form ─────────────────────────────────
    public function showOtpForm()
    {
        if (!session('password_reset_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.verify-otp');
    }

    // ─── Step 4: Verify OTP ──────────────────────────────────────────────────
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('password_reset_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['otp' => 'Session expired। আবার চেষ্টা করুন।']);
        }

        $record = PasswordOtp::where('email', $email)
            ->where('otp', $request->otp)
            ->where('is_used', false)
            ->first();

        if (!$record || !$record->isValid()) {
            return back()->withErrors(['otp' => 'OTP ভুল অথবা মেয়াদ শেষ হয়ে গেছে।']);
        }

        // Generate a temporary token to authorize password reset
        $token = Str::random(64);
        session(['password_reset_token' => $token]);

        // Mark OTP as used
        $record->update(['is_used' => true]);

        return redirect()->route('password.reset.form')
            ->with('success', 'OTP সফলভাবে যাচাই হয়েছে।');
    }

    // ─── Step 5: Show new password form ─────────────────────────────────────
    public function showResetForm()
    {
        if (!session('password_reset_email') || !session('password_reset_token')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password');
    }

    // ─── Step 6: Reset password ──────────────────────────────────────────────
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min'       => 'Password কমপক্ষে ৮ অক্ষরের হতে হবে।',
            'password.confirmed' => 'Password দুটো মিলছে না।',
        ]);

        $email = session('password_reset_email');
        $token = session('password_reset_token');

        if (!$email || !$token) {
            return redirect()->route('password.request')
                ->withErrors(['password' => 'Session expired। আবার চেষ্টা করুন।']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['password' => 'User খুঁজে পাওয়া যায়নি।']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        // Clear session data
        session()->forget(['password_reset_email', 'password_reset_token']);

        // Clear rate limiter
        RateLimiter::clear('otp-send:' . $email);

        return redirect()->route('login')
            ->with('success', 'Password সফলভাবে পরিবর্তন হয়েছে। এখন login করুন।');
    }
}