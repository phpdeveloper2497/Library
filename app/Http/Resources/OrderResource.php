<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->id,
            'user' => new UserResource($this->user),
            'status_id' => $this->status_id,
            'client' => new ClientResource($this->client),
//            'book' => new BookResource($this->book),

//            'to' => $this->to,
        ];
    }
}
