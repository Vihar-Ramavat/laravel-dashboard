@extends('layouts.app')

@section('content')
    @auth
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="bg-gray-800 text-white w-1/7 sm:w-1/6 flex-shrink-0">
                <div class="p-3">
                    <h2 class="text-lg font-bold mb-3 text-center">Dashboard</h2>
                    <ul class="text-sm">
                        <li class="mb-2">
                            <a href="javascript:void(0)" id="home-link" class="block py-2 px-3 hover:bg-gray-700">Home</a>
                        </li>
                        <li class="mb-2">
                            <a href="javascript:void(0)" id="profile-link" class="block py-2 px-3 hover:bg-gray-700">Profile</a>
                        </li>
                    </ul>
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full py-2 px-3 mt-4 bg-red-500 hover:bg-red-600 rounded text-center">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-full">
                <div id="home-content" class="p-4">
                    <!-- Home Content goes here -->
                    <h1 class="text-2xl font-bold mb-4">Welcome to your Dashboard</h1>
                    <p class="text-gray-600">You are logged in!</p>
                </div>
                @include('profile') <!-- Include profile content from separate file -->
            </div>
        </div>
        
        <script>
            // Add event listener to home link
            document.getElementById('home-link').addEventListener('click', function(event) {
                event.preventDefault();
                // Hide profile content, show home content
                document.getElementById('profile-content').classList.add('hidden');
                document.getElementById('home-content').classList.remove('hidden');
            });

            // Add event listener to profile link
            document.getElementById('profile-link').addEventListener('click', function(event) {
                event.preventDefault();
                // Hide home content, show profile content
                document.getElementById('home-content').classList.add('hidden');
                document.getElementById('profile-content').classList.remove('hidden');
            });
        </script>
    @else
        <script>window.location = "{{ route('login') }}";</script>
    @endauth
@endsection
