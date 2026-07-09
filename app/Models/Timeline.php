<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['description', 'start', 'end'])]
class Timeline extends Model
{
   public $timestamps = false;
   public function event()
   {
      return $this->belongsTo(Event::class);
   }

   protected $casts = [
      'start' => 'datetime',
      'end' => 'datetime',
   ];
}
