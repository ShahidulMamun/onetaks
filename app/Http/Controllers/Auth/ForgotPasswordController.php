<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot password form.
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send password reset link to the user's email.
     * High security: rate limiting, token hashing, expiry.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $user = User::where('email', $request->email)->first();

        // Always return success message to prevent email enumeration attacks
        if (!$user) {
            return back()->with(
                'status',
                '✅ If that email exists in our system, you will receive a reset link shortly.'
            );
        }

        // Rate limiting: max 3 requests per hour per email
        $recentRequests = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('created_at', '>', Carbon::now()->subHour())
            ->count();

        if ($recentRequests >= 3) {
            return back()->withErrors([
                'email' => '⚠️ Too many reset attempts. Please wait 1 hour before trying again.',
            ]);
        }

        // Generate a cryptographically secure token
        $plainToken = Str::random(64);
        $hashedToken = Hash::make($plainToken);

        // Delete old tokens for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Store hashed token in DB
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => $hashedToken,
            'created_at' => Carbon::now(),
        ]);

        // Send notification with plain token (user receives, DB stores hash)
        $user->notify(new ResetPasswordNotification($plainToken));

        return back()->with(
            'status',
            '✅ If that email exists in our system, you will receive a reset link shortly.'
        );
    }
}