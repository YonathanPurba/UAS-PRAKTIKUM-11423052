<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the registration form
    public function showRegisterForm()
    {
        return view('user.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->intended('/home');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('user.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        } else {
            return redirect()->back()->with('error_message', 'Invalid username or password');
        }
    }

    // Handle user logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
