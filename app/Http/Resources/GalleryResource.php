<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryResource extends JsonResource
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
            'id'        => $this->id,
            'title'     => $this['title_'.$locale],
            'images'    => GalleryImageResource::collection($this->Images),
        ];
    }
}
