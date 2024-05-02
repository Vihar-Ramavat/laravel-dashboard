<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $validatedData = $request->validate([
        'username' => ['required', 'unique:users', 'regex:/^\S*$/'], // No spaces allowed
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
        'password_confirmation' => ['required', 'same:password'], // Ensure password confirmation matches
    ], [
        'username.regex' => 'Username must not contain spaces.',
        'password.regex' => 'contain at least one uppercase letter, one number, and one special character.',
    ]);

    $user = new User();
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];
    $user->password = Hash::make($validatedData['password']);
    $user->save();

    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
}

    public function showLoginForm()
    {
        return view('auth.login');
    }
}