<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;
   public function categories()
   {
       return $this->belongsToMany(Category::class, 'event_category');
   }

   public function eventType() 
   {
      return $this->belongsTo(EventType::class);
   }

   public function timelines()
   {
       return $this->hasMany(Timeline::class);
   }

   public function Author()
   {
       return $this->belongsTo(User::class);
   }

   public function participants()
   {
       return $this->belongsToMany(Participant::class, 'event_participant')->withTimestamps();
   }

   public function detailEvents()
   {
       return $this->hasMany(DetailEvent::class);
   }
}
