<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\OrderRequest;

class OrderResource extends JsonResource
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
            'service'           => $this->Service ? $this->Service['name_'.$locale] : null,
            'technical_name'    => $this->Technical ? $this->Technical->firstname.' '.$this->Technical->lastname : null,
            'order_number'      => $this->order_number,
            'flat_area'         => $this->flat_area,
            'rooms'             => $this->rooms,
            'bathrooms'         => $this->bathrooms,
            'description'       => $this->description,
            'firstname'         => $this->firstname,
            'lastname'          => $this->lastname,
            'phone'             => $this->phone,
            'governorate'       => $this->governorate,
            'city'              => $this->city,
            'offer_cost'        => $this->offer_cost,
            'status'            => $this->status,
            'offer'             => \Auth::user() && OrderRequest::where('order_id',$this->id)->where('technical_id',\Auth()->user()->id)->first() ? 1 : 0 ,
        ];
    }
}
