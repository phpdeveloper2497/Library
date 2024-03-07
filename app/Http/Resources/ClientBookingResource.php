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
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'passport_series_number' => $this->passport_series_number,
            'address' => $this->address,
            'path' => $this->photo? url(Storage::url($this->photo->path)) : null,
            'bookings' =>  BookBokingResource::collection($this->bookings)
        ];
    }
}
