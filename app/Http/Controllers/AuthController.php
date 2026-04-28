<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // LOGIN FORM
    public function loginForm()
    {
        return view('frontend.auth.login');
    }

    // LOGIN ACTION

public function login(Request $request)
  {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        // admin redirect
        if ($user->role === 'admin' && $user->admin_type == 1) {
            return redirect()->route('admin.dashboard');
        }

        // user redirect
        return redirect()->route('user.dashboard');
    }
        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
   }
    // REGISTER FORM
    public function registerForm()
    {
        return view('.frontend.auth.register');
    }

    // REGISTER ACTION
    public function register(Request $request)
    {
       
        // return $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

      $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'role' => 'user', // force user role
        ]);
          auth()->login($user);
         return redirect()->route('user.dashboard');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}