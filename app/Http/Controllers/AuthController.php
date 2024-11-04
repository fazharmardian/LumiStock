<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $field = $request->validate([
            'username' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        $user = User::create($field);

        Auth::login($user);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $field = $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:3']
        ]);

        $user = User::where('email', $request->email)->first();

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
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function apiRegister(Request $request)
    {
        $field = $request->validate([
            'username' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        $user = User::create($field);

        $token = $user->createToken($request->username);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
            'token' => $token->plainTextToken
        ], 201);
    }

    public function apiLogin(Request $request)
    {
        $field = $request->validate([
            'email' => ['required', 'email', 'max:50'],
            'password' => ['required', 'min:3']
        ]);

        if (Auth::attempt($field, $request->remember)) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $token = $user->createToken($user->username);

            return response()->json([
                'message' => 'User Login successfully.',
                'user' => $user,
                'token' => $token->plainTextToken
            ], 200);
        } else {
            return response()->json(['message' => 'Invalid Credential'], 401);
        }
    }

    public function apiLogout(Request $request) 
    {
        $request->user()->tokens()->delete();
        
        return response()->json(['message' => 'You are logged out.'], 200);
    }
}
