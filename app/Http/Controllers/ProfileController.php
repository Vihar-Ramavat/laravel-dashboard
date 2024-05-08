<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

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

        if ($request->has('first_name')) {
            $updateData['first_name'] = $validatedData['first_name'];
        }
        if ($request->has('last_name')) {
            $updateData['last_name'] = $validatedData['last_name'];
        }
        if ($request->has('phone_number')) {
            $updateData['phone_number'] = $validatedData['phone_number'];
        }
        if ($request->hasFile('profile_photo')) {
            $updateData['profile_photo'] = $validatedData['profile_photo']->store('profile_photos', 'public');
        }

        // Update the user profile data
        $user->update($updateData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        // Validate the form data for password update
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        ], [
            'new_password.regex' => 'The new password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
