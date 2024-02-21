<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  'ok';
//        return true;
    }


    public function rules(): array
    {

        return [
            'category_id' =>'required',
            'name' =>'required|string|max:255',
            'author' =>'required|string|max:255',
            'quantity' =>'required',
//            'photo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:512'

        ];
    }
}
