<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name'])]
class Category extends Model
{
    public $timestamps = false;
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_category');
    }
}
