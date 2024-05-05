@extends('layouts.dashboard')

@section('dashboard_content')
<div class="">
    <div class="bg-white shadow-md rounded px-6 pt-4 pb-6 mb-2">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800">Contacts</h1>
            <button onclick="openAddContactModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add Profile</button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="py-3 px-6 text-left text-sm font-bold text-gray-700 uppercase">First Name</th>
                        <th class="py-3 px-6 text-left text-sm font-bold text-gray-700 uppercase">Last Name</th>
                        <th class="py-3 px-6 text-left text-sm font-bold text-gray-700 uppercase">Email</th>
                        <th class="py-3 px-6 text-left text-sm font-bold text-gray-700 uppercase">Phone No</th>
                        <th class="py-3 px-6 text-center text-sm font-bold text-gray-700 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="border-b border-gray-300">
                        <td class="py-4 px-6">{{ $contact->first_name }}</td>
                        <td class="py-4 px-6">{{ $contact->last_name }}</td>
                        <td class="py-4 px-6">{{ $contact->email }}</td>
                        <td class="py-4 px-6">{{ $contact->phone_number }}</td>
                        <td class="py-4 px-6 text-center">
                            <button onclick="openEditContactModal({{ json_encode($contact) }})" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Edit</button>
                            <button onclick="openDeleteContactModal({{ $contact->id }})" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-2">Delete</button>
                            <button onclick="openViewContactModal({{ $contact->id }})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Add Contact Modal -->
<div id="addContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="modal-dialog bg-white w-1/2 rounded-lg shadow-lg">
        <div class="modal-content p-6">
            <div class="modal-header border-b border-gray-300 pb-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Add Contact</h3>
            </div>
            <div class="modal-body">
                <form id="addForm" action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4 mt-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="first_name_error" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="last_name_error" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" name="email" id="email" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="email_error" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="phone_number_error" class="text-red-500"></span>
                    </div>
                    <!-- Add other form fields as needed -->
                    <div id="error_message" class="text-red-500"></div>
                    <div class="mt-6 flex justify-end">
                        <button onclick="closeAddContactModal()" type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400">Cancel</button>
                        <button onclick="validateForm('add')" type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Contact Modal -->
<div id="editContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="modal-dialog bg-white w-1/2 rounded-lg shadow-lg">
        <div class="modal-content p-6">
            <div class="modal-header border-b border-gray-300 pb-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Edit Contact</h3>
            </div>
            <div class="modal-body">
                <form id="editForm" action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4 mt-4">
                        <label for="edit_first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" id="edit_first_name" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="edit_first_name_error" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="edit_last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" id="edit_last_name" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="edit_last_name_error" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="text" name="email" id="edit_email" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="edit_email_error" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="edit_phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="edit_phone_number" class="mt-1  block w-full shadow-sm sm:text-base border-b border-gray-400 outline-none p-1">
                        <span id="edit_phone_number_error" class="text-red-500"></span>
                    </div>
                    <!-- Add other form fields as needed -->
                    <div id="edit_error_message" class="text-red-500"></div>
                    <div class="mt-6 flex justify-end">
                        <button onclick="closeEditContactModal()" type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md mr-2 hover:bg-gray-400">Cancel</button>
                        <button onclick="validateForm('edit')" type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="modal-dialog bg-white w-1/3 rounded-lg shadow-lg">
        <div class="modal-content p-6">
            <div class="modal-header border-b border-gray-300 pb-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Delete Contact</h3>
            </div>
            <div class="modal-body">
                <p class="text-gray-700">Are you sure you want to delete this contact?</p>
                <div class="mt-6 flex justify-end">
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
<div id="viewContactModal" class="modal hidden fixed inset-0 z-50 overflow-auto bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="modal-dialog bg-white w-1/3 rounded-lg shadow-lg">
        <div class="modal-content p-6">
            <div class="modal-header border-b border-gray-300 pb-3 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">View Contact</h3>
            </div>
            <div class="modal-body">
                <div class="mb-4 mt-4">
                    <label class="block text-sm font-medium text-gray-700">First Name:</label>
                    <p id="view_first_name" class="mt-1"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Last Name:</label>
                    <p id="view_last_name" class="mt-1"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email:</label>
                    <p id="view_email" class="mt-1"></p>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Phone Number:</label>
                    <p id="view_phone_number" class="mt-1"></p>
                </div>
                <!-- Add other contact details here -->
                <div class="mt-6 flex justify-end">
                    <button onclick="closeViewContactModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- JavaScript to handle modals -->
<script>
    function validateForm(formType) {
        let firstNameInput = document.getElementById(formType === 'add' ? 'first_name' : 'edit_first_name');
        let lastNameInput = document.getElementById(formType === 'add' ? 'last_name' : 'edit_last_name');
        let emailInput = document.getElementById(formType === 'add' ? 'email' : 'edit_email');
        let phoneNumberInput = document.getElementById(formType === 'add' ? 'phone_number' : 'edit_phone_number');

        // Get the corresponding error elements
        let firstNameError = document.getElementById(formType === 'add' ? 'first_name_error' : 'edit_first_name_error');
        let lastNameError = document.getElementById(formType === 'add' ? 'last_name_error' : 'edit_last_name_error');
        let emailError = document.getElementById(formType === 'add' ? 'email_error' : 'edit_email_error');
        let phoneNumberError = document.getElementById(formType === 'add' ? 'phone_number_error' : 'edit_phone_number_error');

        // Clear previous error messages when typing
        firstNameInput.addEventListener('input', () => { firstNameError.innerHTML = ''; });
        lastNameInput.addEventListener('input', () => { lastNameError.innerHTML = ''; });
        emailInput.addEventListener('input', () => { emailError.innerHTML = ''; });
        phoneNumberInput.addEventListener('input', () => { phoneNumberError.innerHTML = ''; });

        // Extract input values
        let firstName = firstNameInput.value.trim();
        let lastName = lastNameInput.value.trim();
        let email = emailInput.value.trim();
        let phoneNumber = phoneNumberInput.value.trim();

        // Reset previous error messages
        document.getElementById(formType === 'add' ? 'error_message' : 'edit_error_message').innerHTML = '';

        let isValid = true;

        // Check first name
        if (firstName === '') {
            firstNameError.innerHTML = 'First Name is required';
            isValid = false;
        }

        // Check last name
        if (lastName === '') {
            lastNameError.innerHTML = 'Last Name is required';
            isValid = false;
        }

        // Check email
        if (email === '') {
            emailError.innerHTML = 'Email is required';
            isValid = false;
        } else if (!validateEmail(email)) {
            emailError.innerHTML = 'Enter a valid email address';
            isValid = false;
        }

        // Check phone number
        if (phoneNumber === '') {
            phoneNumberError.innerHTML = 'Phone Number is required';
            isValid = false;
        } else if (!validatePhoneNumber(phoneNumber)) {
            phoneNumberError.innerHTML = 'Enter a valid phone number';
            isValid = false;
        }

        // Submit the form if all inputs are valid
        if (isValid) {
            document.getElementById(formType === 'add' ? 'addForm' : 'editForm').submit();
        }
    }

    // Email validation function
    function validateEmail(email) {
        const re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    // Phone number validation function
    function validatePhoneNumber(phoneNumber) {
        const re = /^\d{10}$/;
        return re.test(phoneNumber);
    }

    // Function to open Add Contact Modal
    function openAddContactModal() {
        document.getElementById('addContactModal').classList.remove('hidden');
    }
    function closeAddContactModal() {
        document.getElementById('addContactModal').classList.add('hidden');
    }

    // Function to open Edit Contact Modal
    function openEditContactModal(contact) {
        // Set the action URL of the edit form
        document.getElementById('editForm').action = `/dashboard/contacts/${contact.id}`;
        document.getElementById('editContactModal').classList.remove('hidden');
        document.getElementById('edit_first_name').value = contact.first_name;
        document.getElementById('edit_last_name').value = contact.last_name;
        document.getElementById('edit_email').value = contact.email;
        document.getElementById('edit_phone_number').value = contact.phone_number;
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
    
    // Function to handle delete action
    function deleteContact() {
        // Get the delete form
        let deleteForm = document.getElementById('deleteForm');
    
        // Prevent the default form submission
        deleteForm.addEventListener('submit', function(event) {
            event.preventDefault();
    
            // Fetch the delete action URL from the form
            let actionUrl = deleteForm.action;
    
            // Send a DELETE request to the action URL
            fetch(actionUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Reload the page or perform any other necessary action
                    location.reload(); // Reload the page for example
                } else {
                    console.error('Error deleting contact');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Function to open View Contact Modal
    function openViewContactModal(contactId) {
        fetch(`/dashboard/contacts/${contactId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('view_first_name').textContent = data.first_name;
            document.getElementById('view_last_name').textContent = data.last_name;
            document.getElementById('view_email').textContent = data.email;
            document.getElementById('view_phone_number').textContent = data.phone_number;

            document.getElementById('viewContactModal').classList.remove('hidden');
        })
        .catch(error => console.error('Error:', error));
    }
    function closeViewContactModal() {
        document.getElementById('viewContactModal').classList.add('hidden');
    }
</script>
@endsection