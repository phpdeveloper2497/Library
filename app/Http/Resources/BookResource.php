<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'book_id' => $this->id,
            'category' => new CategoryResource($this->category),
            'name' => $this->getTranslations('name')->toArray(),
            'author' => $this->getTranslations('author'),
        ];
    }
}
