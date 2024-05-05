<!-- resources/views/layouts/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="w-1/6 bg-gray-900 text-gray-100 h-screen py-4 rounded-r-lg flex flex-col justify-between">
        <div>
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
                        <button type="submit" class="mt-2 bg-red-600 text-white py-1 px-2 w-full hover:bg-red-700 rounded transition duration-300 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="mt-auto">
            <a href="#" class="block px-4 py-2 text-sm text-gray-400 text-center">{{ Auth::user()->username }}</a>
        </div>
    </div>
    <!-- Main Content Area -->
    <div class="w-5/6 p-8 bg-gray-100">
        @yield('dashboard_content')
    </div>
</div>
@endsection
