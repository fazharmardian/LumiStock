<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {   
        // Validate
        $field = $request->validate([
            'username' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        // Register
        $user = User::create($field);

        // Login
        Auth::login($user);

        // Redirect
        return redirect()->intended('home');
    }

    public function login(Request $request)
    {
        // Validate
        $field = $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:3']
        ]);

        // Login Attempt
        if (Auth::attempt($field, $request->remember)) {
            return redirect()->intended('home');
        } else {
            return Back()->withErrors([
                'failed' => 'Incorrect email or password try again.'
            ]);
        }
    }

    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate user session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to home
        return redirect('/');
    }
}
