<?php

namespace App\Http\Resources;

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
            'name' => $this->name,
            'uid' => $this->uid,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status
        ];
    }
}