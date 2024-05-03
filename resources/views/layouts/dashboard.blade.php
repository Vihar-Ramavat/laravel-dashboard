<!-- resources/views/layouts/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="w-1/6 bg-gray-900 text-gray-100 h-screen py-4 rounded-r-lg">
        <ul class="text-base">
            <li class="px-4 py-2 hover:bg-gray-800 rounded">
                <a href="{{ route('dashboard.home') }}" class="block px-4 transition duration-300">Home</a>
            </li>
            <li class="px-4 py-2 hover:bg-gray-800 rounded">
                <a href="{{ route('contacts.index') }}" class="block px-4  transition duration-300">Contacts</a>
            </li>
            <li class="px-4 py-2">
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mt-2 bg-red-600 text-white py-1 px-2 w-full hover:bg-red-700 rounded transition duration-300">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    <!-- Main Content Area -->
    <div class="w-5/6 p-8 bg-gray-100">
        @yield('dashboard_content')
    </div>
</div>
@endsection
