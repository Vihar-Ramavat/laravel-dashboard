@extends('layouts.dashboard')

@section('dashboard_content')
<div class="flex flex-col">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold mb-2">Contacts</h1>
        <!-- Button to Open Add Contact Modal -->
        <button onclick="openAddContactModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Add Profile</button>
    </div>
    <div class="overflow-x-auto">
        <!-- Table to Display Contacts -->
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">First Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Last Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Phone No</th>
                    <th class="px-6 py-3 border-b-2 text-center border-gray-300 text-sm leading-4 font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $contact->first_name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $contact->last_name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $contact->email }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $contact->phone_number }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <!-- Button to Open Edit Contact Modal -->
                        <button onclick="openEditContactModal({{ $contact->id }})" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Edit</button>
                        <!-- Button to Open Delete Contact Modal -->
                        <button onclick="openDeleteContactModal({{ $contact->id }})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2">Delete</button>
                        <!-- Button to Open View Contact Modal -->
                        <button onclick="openViewContactModal({{ $contact->id }})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Contact Modal -->
<div id="addContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50">
    <div class="modal-dialog bg-white w-1/2 mx-auto mt-10 p-6">
        <!-- Modal Content for Adding Contact -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold">Add Contact</h3>
            </div>
            <div class="modal-body">
                <!-- Include form fields to add contact details -->
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button onclick="closeAddContactModal()" type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Contact Modal -->
<div id="editContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50">
    <div class="modal-dialog bg-white w-1/2 mx-auto mt-10 p-6">
        <!-- Modal Content for Editing Contact -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold">Edit Contact</h3>
                <button onclick="closeEditContactModal()" class="text-gray-600 hover:text-gray-800">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Include form fields to edit contact details -->
                <form id="editContactForm" action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="edit_first_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="edit_last_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="edit_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="edit_phone_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button onclick="closeEditContactModal()" type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Confirmation Modal -->
<div id="deleteContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50">
    <div class="modal-dialog bg-white w-1/2 mx-auto mt-10 p-6">
        <!-- Modal Content for Deleting Contact -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold">Delete Contact</h3>
            </div>
            <div class="modal-body">
                <p class="text-gray-700">Are you sure you want to delete this contact?</p>
                <!-- Button to confirm deletion -->
                <div class="mt-4 flex justify-end">
                    <form id="deleteForm" action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                    </form>
                    <button onclick="closeDeleteContactModal()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md ml-2 hover:bg-gray-400">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- View Contact Modal -->
<div id="viewContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50">
    <div class="modal-dialog bg-white w-1/2 mx-auto mt-10 p-6">
        <!-- Modal Content for Viewing Contact -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold">View Contact</h3>
            </div>
            <div class="modal-body">
                <!-- Display contact details -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">First Name:</label>
                    <p id="view_first_name" class="mt-1">{{ $contact->first_name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Last Name:</label>
                    <p id="view_last_name" class="mt-1">{{ $contact->last_name }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email:</label>
                    <p id="view_email" class="mt-1">{{ $contact->email }}</p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Phone Number:</label>
                    <p id="view_phone_number" class="mt-1">{{ $contact->phone_number }}</p>
                </div>
                <!-- Button to close modal -->
                <div class="mt-4 flex justify-end">
                    <button onclick="closeViewContactModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript to handle modals -->
<script>
    // Function to open Add Contact Modal
    function openAddContactModal() {
        document.getElementById('addContactModal').classList.remove('hidden');
    }
    function closeAddContactModal() {
        document.getElementById('addContactModal').classList.add('hidden');
    }

    // Function to open Edit Contact Modal
    function openEditContactModal(contactId) {
        // Fetch contact details via AJAX
        fetch(`/dashboard/contacts/${contactId}/edit`)
            .then(response => response.json())
            .then(data => {
                // Populate form fields with fetched data
                document.getElementById('edit_first_name').value = data.first_name;
                document.getElementById('edit_last_name').value = data.last_name;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_phone_number').value = data.phone_number;
                // Set action URL of form to the appropriate update route
                document.getElementById('editContactForm').action = `/dashboard/contacts/${contactId}`;
                // Show the edit modal
                document.getElementById('editContactModal').classList.remove('hidden');
            })
            .catch(error => console.error('Error:', error));
    }

    function closeEditContactModal() {
        document.getElementById('editContactModal').classList.add('hidden');
    }

    // Function to open Delete Contact Modal
    function openDeleteContactModal(contactId) {
        // Set the action URL of the delete form
        document.getElementById('deleteForm').action = `/dashboard/contacts/${contactId}`;
        document.getElementById('deleteContactModal').classList.remove('hidden');
    }
    function closeDeleteContactModal() {
        document.getElementById('deleteContactModal').classList.add('hidden');
    }

    // Function to open View Contact Modal
    function openViewContactModal(contactId) {
        document.getElementById('viewContactModal').classList.remove('hidden');
    }
    function closeViewContactModal() {
        document.getElementById('viewContactModal').classList.add('hidden');
    }
</script>
@endsection
