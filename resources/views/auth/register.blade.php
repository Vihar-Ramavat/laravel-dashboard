@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <form id="registerForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4 text-center">Create an Account</h2>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" name="username" placeholder="Username" required>
                    <p id="username_error" class="text-red-500 text-xs italic"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="Email" required>
                    <p id="email_error" class="text-red-500 text-xs italic"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Password" required>
                    <p id="password_error" class="text-red-500 text-xs italic"></p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                        Confirm Password
                    </label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>

                <div class="mb-6">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="submit">
                        Register
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-gray-600 text-xs italic">Already have an account? <a class="text-blue-500 hover:text-blue-700" href="{{ route('login') }}">Log in here</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#registerForm').submit(function (event) {
                event.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Get form action URL
                    data: formData,
                    success: function (data) {
                        // Check if the response has a redirect URL
                        if (data.redirect) {
                            // Redirect to the provided URL
                            window.location.href = data.redirect;
                        } else {
                            // Redirect to login page by default if no redirect URL provided
                            window.location.href = '{{ route('login') }}';
                        }
                    },
                    error: function (xhr, status, error) {
                        // Parse error response and display error messages
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#' + key + '_error').html(value);
                        });
                    }
                });
            });
            $('input').on('input', function () {
            var inputId = $(this).attr('id');
            $('#' + inputId + '_error').html('');
            });
        });
    </script>
@endsection
