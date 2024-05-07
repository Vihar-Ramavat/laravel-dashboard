@extends('layouts.dashboard')

@section('dashboard_content')

<div class="container mx-auto mt-8">
    <div id="profileSection" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-800">
            <h1 class="text-3xl font-bold text-white">Profile</h1>
        </div>

        <div class="p-6">
            <div class="flex items-center justify-center mb-6">
                <div class="rounded-full h-24 w-24 flex items-center justify-center bg-gradient-to-r from-purple-400 to-pink-500 text-white text-4xl shadow-md">
                    {{ substr(Auth::user()->username, 0,1) }}
                </div>
            </div>
            <div class="mb-4">
                <p class="text-gray-700"><strong>First Name:</strong> {{ Auth::user()->first_name }}</p>
                <p class="text-gray-700"><strong>Last Name:</strong> {{ Auth::user()->last_name }}</p>
                <p class="text-gray-700"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p class="text-gray-700"><strong>Phone Number:</strong> {{ Auth::user()->phone_number }}</p>
            </div>
            <div class="text-center">
                <button id="openEditProfileFormBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Edit</button>
            </div>
        </div>
    </div>

    <div id="editProfileFormContainer" class="hidden bg-white shadow-lg rounded-lg overflow-hidden mt-4">
        <div class="px-6 py-4 bg-gray-800">
            <h2 class="text-3xl font-bold text-white">Edit Profile</h2>
        </div>
        <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="text" id="email" name="email" value="{{ Auth::user()->email }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button id="saveProfileBtn" type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Save</button>
                <button id="cancelEditBtn" type="button" class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md focus:outline-none focus:shadow-outline">Cancel</button>
            </div>
        </form>
    </div>
</div>



<script>
    const openEditProfileFormBtn = document.getElementById('openEditProfileFormBtn');
    const editProfileFormContainer = document.getElementById('editProfileFormContainer');
    const profileInfoContainer = document.getElementById('profileInfoContainer');
    const saveProfileBtn = document.getElementById('saveProfileBtn');

    document.getElementById('openEditProfileFormBtn').addEventListener('click', function() {
        document.getElementById('profileSection').classList.add('hidden');
        document.getElementById('editProfileFormContainer').classList.remove('hidden');
    });

    document.getElementById('cancelEditBtn').addEventListener('click', function() {
        document.getElementById('editProfileFormContainer').classList.add('hidden');
        document.getElementById('profileSection').classList.remove('hidden');
    });
    
    openEditProfileFormBtn.addEventListener('click', () => {
        editProfileFormContainer.classList.remove('hidden');
    });

    // Function to reset the form and show profile information
    function resetForm() {
        editProfileFormContainer.classList.add('hidden');
    }

    // Event listener for the cancel button
    document.getElementById('cancelEditBtn').addEventListener('click', () => {
        resetForm();
    });

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