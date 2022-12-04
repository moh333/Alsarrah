<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceRateResource extends JsonResource
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
            'id'      => $this->id,
            'name'    => $this->User->firstname .' '. $this->User->lastname,
            'rate'    => $this->rate,
            'date'    => date('d/m/Y',\strtotime($this->created_at)),
            'comment' => $this->comment

        ];
    }
}
