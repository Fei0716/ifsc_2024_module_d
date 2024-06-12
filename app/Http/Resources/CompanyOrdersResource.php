<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'order_id' => $this->id,
            'start_latitude' => $this->start_latitude,
            'start_longitude' => $this->start_longitude,
            'delivery_address' => $this->delivery_address,
            'delivery_provider_name' => $this->delivery_provider_name,
            'delivery_provider_mobile' => $this->delivery_provider_mobile,
            'destination_latitude' => $this->destination_latitude,
            'destination_longitude' => $this->destination_longitude,
            'destination_address' => $this->destination_address,
            'recipient_name' => $this->recipient_name,
            'recipient_mobile' => $this->recipient_mobile,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'courier_id' => $this->courier_id != null ? $this->courier->name : null,
        ];
    }
}
