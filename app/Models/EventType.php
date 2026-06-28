<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description'])]
class EventType extends Model
{
    public $timestamps = false;
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
