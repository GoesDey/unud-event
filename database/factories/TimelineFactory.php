<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Timeline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Timeline>
 */
class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(), 
            'description' => fake()->randomElement(['Registrasi', 'Pembukaan', 'Sesi Utama', 'Penutupan']),
            'start' => now(),
            'end' => now()->addHour(),
        ];
    }
}
