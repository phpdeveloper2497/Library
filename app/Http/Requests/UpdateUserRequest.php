<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
//        dd('ko');
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
//            'password_confirmation' => 'required',
            'phone' => 'required|string',
        ];
//        return [
//            'first_name' => [
//                'required',
//                'string',
//                'max:255'
//            ],
//            'last_name' =>
//             [
//                'required',
//                'string',
//                'max:255'
//                ],
//            'email' => [
//                'required',
//                'email',
//                'max:255'],
//            'password' => ['required'],
//             'password_confirmation' => ['required'],
//                'phone' => [
//                'required',
//                'string',
//                'max:255'
//                ]
//            ];
    }
}
