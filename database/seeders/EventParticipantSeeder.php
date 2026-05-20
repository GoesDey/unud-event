<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $participants = Participant::all();

        foreach ($events as $event) {
            // Mengambil 1 atau 2 target peserta secara acak (Misal: Hanya Mahasiswa & Umum)
            $randomParticipants = $participants->random(rand(1, 2))->pluck('id');

            // Tempelkan ID peserta ke event saat ini
            $event->participants()->attach($randomParticipants);
        }
    }
}
