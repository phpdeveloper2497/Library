<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ClientBookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
//            'client_id' => $this->id,
            "full_name" => $this->full_name,
            "library_card_id" => $this->library_card_id,
            'bookings' => BookingResource::collection($this->whenLoaded('bookings'))
        ];
    }
}
