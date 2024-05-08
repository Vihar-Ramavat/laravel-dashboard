<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password', ['token' => $request->route('token')]);
    }
}