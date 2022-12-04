<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class PriceOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale                 = $request->header('Accept-Language');
        return [
            'id'                => $this->id,
            'casting_type'      => $this->casting_type,
            'order_number'      => $this->order_number,
            'execution_date'    => $this->execution_date,
            'qty_m'             => $this->qty_m,
            'mix_type'          => $this->mix_type,
            'cement_type'       => $this->cement_type,
            'stone_size'        => $this->stone_size,
            'special_description' => $this->special_description,
            'address'           => $this->address,
            'with_pump'         => $this->with_pump,
            'pump_length'       => $this->pump_length,
            'with_snow'         => $this->with_snow,
            'with_lab'          => $this->with_lab,
            'status'            => $this->status,
            'requests_count'    => $this->order_requests()->count(),
            'address'           => $this['address'],
            'request'           => OrderRequestResource::collection($this->order_requests),
        ];
      
    }
}
