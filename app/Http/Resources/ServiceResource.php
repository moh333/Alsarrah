<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale   = $request->header('Accept-Language');
        return [
            'id'     => $this->id,
            'name'   => $this['name_'.$locale],
            'about'  => $this['about_'.$locale],
            'image'  => asset('images/'.$this->image),
            'images' => $this->images ? ServiceImageResource::collection($this->images) : [],
            'rates'  => $this->rates ? ServiceRateResource::collection($this->rates) : [],
        ];
    }
}
