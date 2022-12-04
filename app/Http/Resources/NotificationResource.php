<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Rate;

class NotificationResource extends JsonResource
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
            'order_id'          => $this->order_id,
            'service'           => $this->Order->Service ? $this->Order->Service['name_'.$locale] : null,
            'technical_name'    => $this->Order && $this->Order->Technical ? $this->Order->Technical->firstname.' '.$this->Order->Technical->lastname : null,
            'order_number'      => $this->Order->order_number,
            'flat_area'         => $this->Order->flat_area,
            'rooms'             => $this->Order->rooms,
            'bathrooms'         => $this->Order->bathrooms,
            'description'       => $this->Order->description,
            'firstname'         => $this->Order->firstname,
            'lastname'          => $this->Order->lastname,
            'phone'             => $this->Order->phone,
            'governorate'       => $this->Order->governorate,
            'city'              => $this->Order->city,
            'offer_cost'        => $this->Order->offer_cost,
            'status'            => \Auth::user() && Rate::where('user_id',\Auth()->user()->id)->where('service_id',$this->order_id)->first() ? 1 : 0 ,
        ];
    }
}
