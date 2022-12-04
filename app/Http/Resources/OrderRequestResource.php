<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderRequestResource extends JsonResource
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
            'company'           => $this->Company['name_'.$locale] ?? '',
            'image'             => asset('images/'.$this->Company->image),
            'distance'          => self::point2point_distance($request->lat,$request->lng,$this->Company->lat,$this->Company->lng),
            'rate'              => $this->Company->rating(),
            'price'             => $this->price,
            'status'            => $this->status,
        ];
    }

    function point2point_distance($lat1, $lon1, $lat2, $lon2) 
    { 
        $theta = $lon1 - $lon2; 
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
        $dist = acos($dist); 
        $dist = rad2deg($dist); 
        $miles = ($dist * 60 * 1.1515) * 1.609344;
        return round($miles, 0);
    }
}
