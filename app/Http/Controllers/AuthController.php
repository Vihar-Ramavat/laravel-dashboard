<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    public function showRegistrationForm(){
        return view('auth.register');
    }

    public function register(\App\Http\Requests\RegistrationRequest $request){
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){    
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors(['invalid' => 'Invalid username or password'])->withInput();
        }
    }
}