@extends('layouts.app')

@section('content')
    @auth
        <div class="flex justify-center items-center h-screen">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <h2 class="text-2xl font-bold mb-4 text-center">Dashboard</h2>
                    <p class="text-gray-600 text-xs italic">You are logged in!</p>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <button class="text-gray-600 hover:text-gray-900">Logout</button>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    @else
        <script>window.location = "{{ route('login') }}";</script>
    @endauth
@endsection
