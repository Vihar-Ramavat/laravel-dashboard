@extends('layouts.dashboard')

@section('dashboard_content')

<!-- Dashboard Layout -->
<div class="container mx-auto mt-8">
        <!-- Profile Section -->
        <div id="profileSection" class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Dashboard Header -->
            <div class="px-6 py-4 bg-gray-800">
                <h1 class="text-3xl font-bold text-white">Profile</h1>
            </div>

            <!-- Profile Content -->
            <div class="p-6">
                <div class="flex items-center justify-center mb-6">
                    <!-- Profile Picture -->
                    @if (Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Picture" class="rounded-full h-24 w-24">
                    @else
                        <div class="rounded-full h-24 w-24 flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500 text-white text-4xl shadow-md">
                            {{ substr(Auth::user()->username, 0,1) }}
                        </div>
                    @endif
                </div>
                <!-- Profile Information -->
                <div class="mb-4">
                    <p class="text-gray-700"><strong>First Name:</strong> {{ Auth::user()->first_name }}</p>
                    <p class="text-gray-700"><strong>Last Name:</strong> {{ Auth::user()->last_name }}</p>
                    <p class="text-gray-700"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p class="text-gray-700"><strong>Phone Number:</strong> {{ Auth::user()->phone_number }}</p>
                </div>
                <!-- Edit Button -->
                <div class="text-center">
                    <button id="openEditProfileFormBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Edit</button>
                </div>
            </div>            
        </div>

        <!-- Change Password Button -->
        <button id="openChangePasswordFormBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline mt-4">Change Password</button>

        <!-- Edit Profile Form -->
        <div id="editProfileFormContainer" class="hidden bg-white shadow-lg rounded-lg overflow-hidden mt-4">
            <div class="px-6 py-4 bg-gray-800">
                <h2 class="text-3xl font-bold text-white">Edit Profile</h2>
            </div>
            <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- Profile Picture Input -->
                <div class="mb-4">
                    <label for="profile_photo" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture</label>
                    <input type="file" id="profile_photo" name="profile_photo" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- First Name Input -->
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Last Name Input -->
                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="text" id="email" name="email" value="{{ Auth::user()->email }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Phone Number Input -->
                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Save and Cancel Buttons -->
                <div class="flex items-center justify-between">
                    <button id="saveProfileBtn" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Save</button>
                    <button id="cancelEditBtn" type="button" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Cancel</button>
                </div>
            </form>
        </div>

        <!-- Change Password Form -->
<div id="changePasswordFormContainer" class="hidden bg-white shadow-lg rounded-lg overflow-hidden mt-4">
    <div class="px-6 py-4 bg-gray-800">
        <h2 class="text-3xl font-bold text-white">Change Password</h2>
    </div>
    <form id="changePasswordForm" action="{{ route('profile.updatePassword') }}" method="POST" class="p-6">
        @csrf
        @method ('PUT')

        <!-- Current Password Input -->
        <div class="mb-4">
            <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('current_password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password Input -->
        <div class="mb-4">
            <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
            <input type="password" id="new_password" name="new_password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('new_password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm New Password Input -->
        <div class="mb-4">
            <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('new_password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Save and Cancel Buttons -->
        <div class="flex items-center justify-between">
            <button id="savePasswordBtn" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Save</button>
            <button id="cancelChangePasswordBtn" type="button" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Cancel</button>
        </div>
    </form>
</div>

    <!-- Scripts -->
    <script>
        // Edit Profile Form Controls
        const openEditProfileFormBtn = document.getElementById('openEditProfileFormBtn');
        const editProfileFormContainer = document.getElementById('editProfileFormContainer');
        const saveProfileBtn = document.getElementById('saveProfileBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const profileSection = document.getElementById('profileSection');
        const changePasswordBtn = document.getElementById('openChangePasswordFormBtn');

        // Open Edit Profile Form
        openEditProfileFormBtn.addEventListener('click', () => {
            editProfileFormContainer.classList.remove('hidden');
            profileSection.classList.add('hidden');
            changePasswordBtn.classList.add('hidden');
        });

        // Cancel Edit Profile Form
        cancelEditBtn.addEventListener('click', () => {
            editProfileFormContainer.classList.add('hidden');
            profileSection.classList.remove('hidden');
            changePasswordBtn.classList.remove('hidden');
        });

        // Save Profile
        saveProfileBtn.addEventListener('click', () => {
            console.log('Save button clicked');
            const formData = new FormData(document.getElementById('editProfileForm'));
            console.log([...formData.entries()]);
            fetch('{{ route("profile.update") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    console.log('Profile updated successfully');
                    window.location.reload();
                } else {
                    console.error('Error updating profile');
                }
            })
            .catch(error => {
                console.error('Error updating profile:', error);
            });
        });

        // Change Password Form Controls
        const openChangePasswordFormBtn = document.getElementById('openChangePasswordFormBtn');
        const changePasswordFormContainer = document.getElementById('changePasswordFormContainer');
        const savePasswordBtn = document.getElementById('savePasswordBtn');
        const cancelChangePasswordBtn = document.getElementById('cancelChangePasswordBtn');

        // Open Change Password Form
        openChangePasswordFormBtn.addEventListener('click', () => {
            changePasswordFormContainer.classList.remove('hidden');
            profileSection.classList.add('hidden');
            changePasswordBtn.classList.add('hidden');
        });

        // Cancel Change Password Form
        cancelChangePasswordBtn.addEventListener('click', () => {
            changePasswordFormContainer.classList.add('hidden');
            profileSection.classList.remove('hidden');
            changePasswordBtn.classList.remove('hidden');
        });

        // Save Password
        savePasswordBtn.addEventListener('click', () => {
            console.log('Save Password button clicked');
            document.getElementById('changePasswordForm').submit();
        });
    </script>
@endsection