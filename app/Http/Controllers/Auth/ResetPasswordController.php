<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Show the password reset form.
     * Token expiry: 60 minutes (configurable via AUTH_RESET_EXPIRY in .env)
     */
    public function showResetForm(Request $request, string $token)
    {
        // Validate token exists before showing form
        $record = DB::table('password_reset_tokens')
            ->where('email', $request->query('email'))
            ->first();

        if (!$record) {
            return redirect()->route('password.request')
                ->withErrors(['email' => '❌ Invalid or expired reset link.']);
        }

        $expiry = config('auth.passwords.users.expire', 60); // minutes
        if (Carbon::parse($record->created_at)->addMinutes($expiry)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->query('email'))->delete();
            return redirect()->route('password.request')
                ->withErrors(['email' => '❌ This reset link has expired. Please request a new one.']);
        }

        if (!Hash::check($token, $record->token)) {
            return redirect()->route('password.request')
                ->withErrors(['email' => '❌ Invalid reset link.']);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Reset the password with full validation.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[A-Z]/',        // At least one uppercase
                'regex:/[a-z]/',        // At least one lowercase
                'regex:/[0-9]/',        // At least one number
                'regex:/[@$!%*#?&]/',   // At least one special character
            ],
        ], [
            'password.regex'     => 'Password must contain uppercase, lowercase, number, and special character (@$!%*#?&).',
            'password.min'       => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record) {
            return back()->withErrors(['email' => '❌ Invalid or expired reset link.']);
        }

        // Check expiry
        $expiry = config('auth.passwords.users.expire', 60);
        if (Carbon::parse($record->created_at)->addMinutes($expiry)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return redirect()->route('password.request')
                ->withErrors(['email' => '❌ This reset link has expired. Please request a new one.']);
        }

        // Validate token
        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => '❌ Invalid reset token.']);
        }

        // Find user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => '❌ No account found with this email.']);
        }

        // Prevent reuse of same password
        if (Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => '⚠️ New password cannot be the same as your current password.']);
        }

        // Update password
        $user->update([
            'password'       => Hash::make($request->password),
            'remember_token' => null, // Invalidate all remember-me sessions
        ]);

        // Delete used token (one-time use)
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Optional: Log out all other sessions (requires Sanctum/session guard)
        // auth()->logoutOtherDevices($request->password);

        return redirect()->route('login')
            ->with('status', '✅ Password reset successfully! Please login with your new password.');
    }
}