<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $guarded  = [];

    public function Images()
    {
        return $this->hasMany(Gallery_image::class);
    }

}

