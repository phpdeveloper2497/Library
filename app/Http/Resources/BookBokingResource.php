<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookBokingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "booking_id" =>$this->id,
            "booking_created" =>$this->created_at,
            "booking_to" =>$this->to,
            'book_id' => $this->book->id,
            'book_name' => $this->book->getTranslations('name'),
            'book_author' => $this->book->getTranslations('author'),
            'created_at_book' => $this->book->created_at_book,
        ];
    }
}
