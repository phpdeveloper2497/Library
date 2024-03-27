<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'booking_id' => $this->id,
            'user_id' => $this->user['id'],
            'status_id' => $this->status_id,
//            'book' => new BookBokingResource($this->whenLoaded('book')),
            'client_id' => $this->client->id,
        ];
    }
}
