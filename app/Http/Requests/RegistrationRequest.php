<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to true for authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'unique:users', 'regex:/^\S*$/'], 
            'email' => ['required', 'email', 'regex:/^(?=.{1,256}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'password_confirmation' => ['required', 'same:password'],
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone_number' => 'string|max:10',
        ];  
    }
    
    public function messages()
    {
        return [
            'username.regex' => 'Username must not contain spaces.',
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.',
            'email.regex' => 'Invalid email address.',
            'password_confirmation.same' => 'Password confirmation does not match.',
        ];
    }
}