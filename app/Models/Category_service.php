<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_service extends Model
{
    protected $guarded  = [];
    protected $table  = 'category_service';
  
    public function Category()
    {
        return $this->hasOne(Category::class,'id','category');
    }

    public function Service()
    {
        return $this->hasOne(Service::class,'id','service');
    }

}

