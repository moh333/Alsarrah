<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded  = [];

    public function Order()
    {
        return $this->hasOne(Order::class,'id','order_id');
    }

}

