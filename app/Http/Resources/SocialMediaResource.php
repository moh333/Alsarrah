<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $locale             = $request->header('Accept-Language');
        return [
            'whatsapp'      => $this->whatsapp,
            'instagram'     => $this->instagram,
            'twitter'       => $this->twitter,
            'snapchat'      => $this->snapchat,
            'phone_numbers' => $this->phone_numbers,
        ];
    }
}
