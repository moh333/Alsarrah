<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded  = ['id'];

    public function Service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function Technical()
    {
        return $this->hasOne(User::class,'id','technical_id');
    }

    public function order_requests()
    {
        return $this->hasMany(OrderRequest::class,'order_id');
    }

    

}

