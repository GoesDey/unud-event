<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::instance(fake()->dateTimeBetween('now', '+2 months'));
        $endDate = (clone $startDate)->addDays(fake()->numberBetween(0, 3));
        return [
            'user_id' => User::factory(),
            'event_type_id' => EventType::inRandomOrder()->first()->id,
            'description' => fake()->paragraph(3, true),
            'faculty' => null,
            'major' => null,
            
            'picture' => 'events/sample-cover-' . fake()->numberBetween(1, 5) . '.jpg',
            
            'location' => fake()->randomElement(['online', 'offline']),
            'is_paid' => fake()->boolean(30),
            
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),

        ];
    }
}
