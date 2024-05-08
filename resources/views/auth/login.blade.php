@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gradient-to-r from-purple-800 to-indigo-900">
        <div class="w-full max-w-md bg-white shadow-md rounded-lg px-8 py-10">
            <h2 class="text-3xl text-center font-bold mb-6 text-indigo-500">Log in to Your Account</h2>

            <form id="loginForm" class="mb-4" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <input class="border-b border-indigo-300 w-full py-2 px-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:border-indigo-500" id="username" type="text" name="username" placeholder="Username" required value="{{ old('username') }}">
                    <p id="username_error" class="text-red-500 text-xs italic"></p>
                </div>

                <div class="mb-4 relative">
                    <input class="border-b border-indigo-300 w-full py-2 px-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:border-indigo-500" id="password" type="password" name="password" placeholder="Password" required>
                    <svg id="showPassword" class="absolute right-3 top-3 h-6 w-5 cursor-pointer text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg id="hidePassword" class="absolute right-3 top-3 h-6 w-5 cursor-pointer text-gray-500 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <p id="password_error" class="text-red-500 text-xs italic"></p>
                </div>

                <button id="loginBtn" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline w-full" type="submit">
                    Log in
                </button>

                @if($errors->has('invalid'))
                    <div class="mt-4 text-center">
                        <p class="text-red-500 text-sm italic">{{ $errors->first('invalid') }}</p>
                    </div>
                @endif
            </form>

            <div class="text-center text-gray-500 text-sm">
                <p>Don't have an account? <a class="text-indigo-500 hover:text-indigo-600" href="{{ route('register') }}">Sign up here</a></p>
            </div>
            <div class="text-center text-gray-500 text-sm mt-2">
    <a href="{{ route('password.request') }}" class="text-indigo-500 hover:text-indigo-600">Forgot your password?</a>
</div>
        </div>
    </div>

    <script>
        const showPasswordIcon = document.getElementById('showPassword');
        const hidePasswordIcon = document.getElementById('hidePassword');
        const passwordInput = document.getElementById('password');

        showPasswordIcon.addEventListener('click', () => {
            passwordInput.type = 'text';
            showPasswordIcon.classList.add('hidden');
            hidePasswordIcon.classList.remove('hidden');
        });

        hidePasswordIcon.addEventListener('click', () => {
            passwordInput.type = 'password';
            hidePasswordIcon.classList.add('hidden');
            showPasswordIcon.classList.remove('hidden');
        });
    </script>
@endsection
