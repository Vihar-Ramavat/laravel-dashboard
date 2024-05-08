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
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone_number' => 'string|max:10',
        ]);
        
        // Get the authenticated user
        $user = auth()->user();

        // Prepare the data to update
        $updateData = [];

        if (isset($validatedData['first_name'])) {
            $updateData['first_name'] = $validatedData['first_name'];

        }
        if (isset($validatedData['last_name'])) {
            $updateData['last_name'] = $validatedData['last_name'];
        }
        if (isset($validatedData['phone_number'])) {
            $updateData['phone_number'] = $validatedData['phone_number'];
        }
        if (isset($validatedData['profile_photo'])) {
            $updateData['profile_photo'] = $validatedData['profile_photo']->store('profile_photos', 'public');
        }

        // Update the user profile data
        $user->update($updateData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        throw ValidationException::withMessages([
            'current_password' => ['The provided password does not match your current password.'],
        ]);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('success', 'Password updated successfully.');
}
}