<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public $timestamps = false;
   public function faculty()
   {
       return $this->belongsTo(Faculty::class);
   }

   public function users()
   {
       return $this->hasMany(User::class);
   }
}
