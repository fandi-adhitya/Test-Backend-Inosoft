<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'customer'        => $this->customer,
            'quantity'        => $this->quantity,
            'price_per_unit'  => $this->price_per_unit,
            'price_total'     => $this->price_total,
            'vehicle'         => new VehicleResource($this->whenLoaded('vehicle'))
        ];
    }
}
