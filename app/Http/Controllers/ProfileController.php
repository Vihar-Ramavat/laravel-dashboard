<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;


use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show()
    {
        // Retrieve the authenticated user's profile
        $user = auth()->user();

        // Return the profile view with user data
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
    // Validate the form data
    $validatedData = $request->validate([
        'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'first_name' => 'string|max:255',
        'last_name' => 'string|max:255',
        'phone_number' => 'string|max:10',
    ]);

    // Get the authenticated user
    $user = auth()->user();

    // Update the user profile data
    $user->update([
        'first_name' => $validatedData['first_name'],
        'last_name' => $validatedData['last_name'],
        'phone_number' => $validatedData['phone_number'],
        'profile_photo' => $validatedData['profile_photo']
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}