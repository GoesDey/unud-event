<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['label', 'value'])]
class DetailEvent extends Model
{
   public $timestamps = false;
   public function event()
   {
      return $this->belongsTo(Event::class);
   }
}
