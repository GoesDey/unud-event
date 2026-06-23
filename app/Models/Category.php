<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
   public function events()
   {
       return $this->belongsToMany(Event::class, 'event_category');
   }
}
