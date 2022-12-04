<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded  = ['service'];

    public function Services()
    {
        return $this->hasMany(Category_service::class);
    }

    public function ManyServices()
    {
        return $this->belongsToMany(Service::class);
    }
}

