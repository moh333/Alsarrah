<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    protected $guarded  = [];

    public function Technical()
    {
        return $this->hasOne(User::class,'id','technical_id');
    }

    public function Order()
    {
        return $this->hasOne(Order::class,'id','order_id');
    }
}

