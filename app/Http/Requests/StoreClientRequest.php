<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
        return [
            "full_name" => "required|string|max:255",
            "library_card_id" => "required",
            "phone_number" => "required",
            "photo" => "nullable|file|mimes:jpeg,bmp,png|max:512",

        ];
    }
}
