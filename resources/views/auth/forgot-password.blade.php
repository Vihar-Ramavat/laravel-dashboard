@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gradient-to-r from-purple-800 to-indigo-900">
        <div class="w-full max-w-md bg-white shadow-md rounded-lg px-8 py-10">
            <h2 class="text-3xl text-center font-bold mb-6 text-indigo-500">Forgot Your Password?</h2>

            <form method="POST" action="{{ route('password.email') }}" class="mb-4">
                @csrf

                <div class="mb-4">
                    <input class="border-b border-indigo-300 w-full py-2 px-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:border-indigo-500" id="email" type="email" name="email" placeholder="Enter your email">
                </div>

                <button class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline w-full" type="submit">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
@endsection