<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'release_year'    => $this->year,
            'color'           => $this->color,
            'price'           => $this->price,
            'stock'           => $this->stock,
            'car'             => new CarResource($this->whenLoaded('car')),
            'motorcycle'      => new MotorcycleResource($this->whenLoaded('motorcycle')),
            'transactions'    => new TransactionCollection($this->whenLoaded('transactions')),
            'createdAt'       => $this->created_at->format('c'),
            'updatedAt'       => $this->updated_at->format('c'),
        ];
    }
}
