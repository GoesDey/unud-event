<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
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
       return $this->belongsToMany(Participant::class, 'event_participant');
   }

   public function detailEvents()
   {
       return $this->hasMany(DetailEvent::class);
   }
}
