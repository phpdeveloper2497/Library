<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' =>'required|email|max:255',
            'password' => 'required',
            'password_confirmation' => 'required',
            'phone' =>'required|string|max:255',
//            'photo' =>'nullable'
//            'first_name' => 'required|string',
//            'last_name' => 'nullable|string',
//            'email' => 'required|email:rfc,dns|unique:users,email',
//            'phone' => 'required|unique:users,phone',
//            'password' => 'required|min:8',
//            'password_confirmation' => 'required|same:password',
////            'photo' => 'nullable|file|mimes:jpeg,bmp,png|max:512',


        ];
    }
}
