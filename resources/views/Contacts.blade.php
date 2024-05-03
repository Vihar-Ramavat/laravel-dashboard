@extends('layouts.dashboard')

@section('dashboard_content')
<div class="flex flex-col">
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold mb-2">Contacts</h1>
        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 inline-block">Add Profile</a>
    </div>
    <div class="overflow-x-auto">
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
                <!-- Sample Data - Replace with dynamic data from database -->
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">John</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">Doe</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">john.doe@example.com</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">1234567890</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                        <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                        <a href="#" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2">Delete</a>
                        <a href="#" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2">View</a>
                    </td>
                </tr>
                <!-- End Sample Data -->
            </tbody>
        </table>
    </div>
</div>
@endsection
