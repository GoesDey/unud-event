<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $categories = Category::all();

        foreach ($events as $event) {
            $randomCategories = $categories->random(rand(1, 3))->pluck('id');

            $event->categories()->attach($randomCategories);
        }
    }
}
