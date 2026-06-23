<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Lomba',
            'Seminar',
            'Pengabdian',
            'Workshop',
            'Webinar'
        ];

        foreach ($types as $type) {
            EventType::create([
                'name' => $type
            ]);
        }
    }
}
