<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function Profile(){

    	return view('admin.profile.index');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin' || (int) $admin->admin_type !== 1) {
            abort(403, 'Unauthorized access.');
        }

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'default')
                ->with('password_error', 'Please fix the errors below.');
        }

        $validated = $validator->validated();

        if (!Hash::check($validated['current_password'], $admin->password)) {
            Log::warning('Admin password update failed: wrong current password', [
                'user_id' => $admin->id,
                'ip'      => $request->ip(),
            ]);

            return redirect()->back()->with('password_error', 'Current password is incorrect.');
        }

        if (Hash::check($validated['password'], $admin->password)) {
            return redirect()->back()->with('password_error', 'New password must be different from current password.');
        }

        try {
            DB::transaction(function () use ($admin, $validated) {
                $admin->password = Hash::make($validated['password']);
                $admin->save();
            });

            $request->session()->regenerate();

            Log::info('Admin password changed', [
                'user_id' => $admin->id,
                'ip'      => $request->ip(),
            ]);

            return redirect()->back()->with('password_success', 'Password updated successfully.');

        } catch (\Throwable $e) {
            Log::error('Admin password update failed: ' . $e->getMessage(), [
                'user_id' => $admin->id,
            ]);

            return redirect()->back()->with('password_error', 'Something went wrong. Please try again.');
        }
    }


    public function updateProfile(Request $request)
    {
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin' || (int) $admin->admin_type !== 1) {
            abort(403, 'Unauthorized access.');
        }

        // -------- Sanitize input --------
        $name  = trim(strip_tags((string) $request->input('name')));
        $email = strtolower(trim(strip_tags((string) $request->input('email'))));

        $request->merge([
            'name'  => $name,
            'email' => $email,
        ]);

        // -------- Validation --------
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z0-9_\.\s]+$/',
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:100',
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
            'current_password' => [
                'required',
                'string',
            ],
        ], [
            'name.regex'  => 'Username can only contain letters, numbers, underscore, dot and space.',
            'email.email' => 'Please enter a valid, deliverable email address.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'default')
                ->withInput($request->except('current_password'))
                ->with('profile_error', 'Please fix the errors below.');
        }

        $validated = $validator->validated();

        // -------- Re-confirm current password (sensitive action) --------
        if (!Hash::check($validated['current_password'], $admin->password)) {
            Log::warning('Admin profile update failed: wrong current password', [
                'user_id' => $admin->id,
                'ip'      => $request->ip(),
            ]);

            return redirect()->back()
                ->withInput($request->except('current_password'))
                ->with('profile_error', 'Current password is incorrect.');
        }

        try {
            DB::transaction(function () use ($admin, $validated) {
                $admin->name  = $validated['name'];
                $admin->email = $validated['email'];
                $admin->save();
            });

            Log::info('Admin profile updated', [
                'user_id' => $admin->id,
                'ip'      => $request->ip(),
            ]);

            return redirect()->back()->with('profile_success', 'Profile updated successfully.');

        } catch (\Throwable $e) {
            Log::error('Admin profile update failed: ' . $e->getMessage(), [
                'user_id' => $admin->id,
            ]);

            return redirect()->back()->with('profile_error', 'Something went wrong. Please try again.');
        }
    }
}




    

    