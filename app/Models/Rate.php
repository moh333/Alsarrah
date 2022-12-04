<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $guarded  = [];

    public function Service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

}

