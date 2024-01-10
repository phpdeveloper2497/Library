<?php

namespace App\Http\Requests;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            "client_id" =>'required|numeric',
            'books' => 'required',
            'books.*.book_id' =>[
                'required',
                'numeric',
                function($attribute, $value,$fail)
                {
                    $book = Book::find($value);
                    if(!$book)
                    {
                        $fail('Book not found in the library');
                    }else{
                        if($book->quantity === 0)
                        {
                            $fail('there is no such book left in the library for this '. $book->id);
                        }
                    }
                }
            ],
            'books.*.to' => [
                'required',
                'date'
            ],
            'status_id' =>'required|numeric'
        ];
    }
}
