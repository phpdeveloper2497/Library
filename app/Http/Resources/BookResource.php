<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BookResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'book_id' => $this->id,
            'category' => new CategoryResource($this->category),
            'name' => $this->getTranslations('name'),
            'author' => $this->getTranslations('author'),
            'created_at_book' => $this->created_at_book,
            'quantity' => $this->quantity,
            'path' => $this->photo ? url(Storage::url($this->photo->path)) : null,
            'created_at' => $this->created_at,
        ];
    }
}
