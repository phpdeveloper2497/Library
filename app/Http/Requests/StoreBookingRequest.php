<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'client_id' => [
                'required',
                'numeric'
            ],
            'books' => [
                'required',
                'array'
            ],
            'books.*.book_id' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    $book = Book::find($value);
                    if (!$book) {
                        $fail('Book not found in the library');
                    } else {
                        if ($book->quantity === 0) {
                            $fail('there is no such book left in the library for this ' . $book->id);
                        }
                    }
                }
            ],
            'books.*.to' => [
                'required',
            ],
            'status_id' => 'required|numeric'
        ];
    }
}
