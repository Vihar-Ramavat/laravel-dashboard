@extends('layouts.dashboard')

@section('dashboard_content')

<div class="bg-white shadow-md rounded px-6 pt-4 pb-6 mb-2">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-gray-800">Profile</h1>
        <!-- Button to open the edit form -->
        <button id="openEditProfileFormBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Edit</button>
    </div>

    <!-- Profile information -->
    <div id="profileInfoContainer">
        <!-- Display profile picture -->
        <div class="rounded-full h-14 w-14 flex items-center justify-center bg-purple-400 text-black text-5xl shadow-md mb-4">
            {{ substr(Auth::user()->username, 0,1) }}
        </div>
        <p><strong>First Name:</strong> {{ Auth::user()->first_name }}</p>
        <p><strong>Last Name:</strong> {{ Auth::user()->last_name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Phone Number:</strong> {{ Auth::user()->phone_number }}</p>
    </div>
</div>

<div id="editProfileFormContainer" class="hidden bg-white shadow-md rounded px-6 pt-4 pb-6 mb-2">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Profile</h2>
    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- First Name -->
        <div class="mb-4">
            <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
            <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="text" id="email" name="email" value="{{ Auth::user()->email }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Save and Cancel Buttons -->
        <div class="mb-4">
            <button id="saveProfileBtn" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Save</button>
            <button id="cancelEditBtn" type="button" class="ml-4 bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">Cancel</button>
        </div>
    </form>
</div>

<script>
    const openEditProfileFormBtn = document.getElementById('openEditProfileFormBtn');
    const editProfileFormContainer = document.getElementById('editProfileFormContainer');
    const profileInfoContainer = document.getElementById('profileInfoContainer');
    const saveProfileBtn = document.getElementById('saveProfileBtn');
    
    openEditProfileFormBtn.addEventListener('click', () => {
        // Show the edit form container
        editProfileFormContainer.classList.remove('hidden');
        // Hide the profile information container
        profileInfoContainer.classList.add('hidden');
    });

    // Function to reset the form and show profile information
    function resetForm() {
        // Reset the form here
        // Show the profile information container
        profileInfoContainer.classList.remove('hidden');
        // Hide the edit form container
        editProfileFormContainer.classList.add('hidden');
    }

    // Event listener for the cancel button
    document.getElementById('cancelEditBtn').addEventListener('click', () => {
        resetForm();
    });

    // Event listener for the save button
    // Event listener for the save button
saveProfileBtn.addEventListener('click', () => {
    console.log('Save button clicked'); // Debugging
    // Create FormData object to collect form data
    const formData = new FormData(document.getElementById('editProfileForm'));
    console.log([...formData.entries()]);
    // Submit the form data using fetch API
    fetch('{{ route("profile.update") }}', {
        method: 'PUT',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => {
        // Check if the request was successful
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

</script>
@endsection
