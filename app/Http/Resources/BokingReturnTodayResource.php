<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BokingReturnTodayResource extends JsonResource
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
            'book' => new BookBokingResource($this->book),
//            'client_name' => $this->client['full_name'],
//            'client_email' => $this->client['email'],
//            'client_number' => $this->client['phone_number'],
            'client' => collect($this->client->toArray())->only('full_name', 'email', 'phone_number')
            ];
    }
}
