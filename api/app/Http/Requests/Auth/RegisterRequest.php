<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      => 'required|string',
            'email'     => 'required|max:255|email|unique:users',
            'password'  => 'required|confirmed',
        ];
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages()
    {
        return [
            'name.required'     => 'User name is missing!',
            'email.required'    => 'Email address is missing!',
            'email.unique'      => 'This email has been used already!',
            'password.required' => 'Password is missing'
        ];
    }
}
