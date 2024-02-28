<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'client_id' => $this->id,
//            'bookings' => new BookBokingResource(new BookingResource($this->booking)),
//            'bookings' => new ClientResource($this->booking),
              'bookings' => BookingResource::collection($this->whenLoaded('bookings'))
        ];
    }
}
