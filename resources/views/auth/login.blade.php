@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <!-- Login Form -->
            <form id="loginForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Enter Username" required value="{{ old('username') }}">
                    <p id="username_error" class="text-red-500 text-xs italic"></p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Password" required>
                    <p id="password_error" class="text-red-500 text-xs italic"></p>
                </div>

                <div class="mb-6">
                    <button id="loginBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                        Log in
                    </button>
                </div>

                @if($errors->has('invalid'))
                    <div class="mb-4">
                        <p class="text-red-500 text-xs italic">{{ $errors->first('invalid') }}</p>
                    </div>
                @endif

                <div class="text-center">
                    <p class="text-gray-600 text-xs italic">Don't have an account? <a class="text-blue-500 hover:text-blue-700" href="{{ route('register') }}">Sign up here</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
