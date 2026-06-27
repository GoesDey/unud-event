<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[
   Fillable([
      'user_id',
      'event_type_id',
      'name',
      'description',
      'faculty',
      'major',
      'instance',
      'picture',
      'link',
      'status',
      'location',
      'price',
      'start_date',
      'end_date',
   ]),
]
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

   protected function statusDate(): Attribute
   {
      return Attribute::make(
         get: function () {
            $now = Carbon::now();

            if ($now->lt($this->start_date)) {
               return 'upcoming';
            } elseif ($now->between($this->start_date, $this->end_date)) {
               return 'ongoing';
            } else {
               return 'ended';
            }
         },
      );
   }
}
