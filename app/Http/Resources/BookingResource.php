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
            'user' =>  new UserBokingResource($this->user),      /*new UserResource($this->user),*/
            'status_id' => $this->status_id,
            'book' => new BookBokingResource($this->book),
            'client' => new ClientResource($this->client),
        ];
    }
}
