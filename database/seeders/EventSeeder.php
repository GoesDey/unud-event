<?php

namespace Database\Seeders;

use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Timeline;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $eventTypes = EventType::all();

        for ($i = 0; $i < 5; $i++) {
            $randomUser = $users->random();
            $randomType = $eventTypes->random();

            $event = Event::factory()->create([
                'user_id' => $randomUser->id,
                'event_type_id' => $randomType->id,
                
                'faculty' => $randomUser->faculty ? $randomUser->faculty->name : null,
                'major' => $randomUser->major ? $randomUser->major->name : null,
            ]);

            $detailsPreset = [
                'Narasumber' => fake()->name() . ' (' . fake()->jobTitle() . ')',
                'Benefit' => 'Sertifikat Nasional, Makan Siang Gratis, Merchandise Kit',
                'Contact Person' => fake()->name() . ' (08' . fake()->numerify('########') . ')',
                'Syarat & Ketentuan' => 'Membawa KTM aktif dan mengenakan pakaian rapi berkemeja.',
            ];

            foreach ($detailsPreset as $label => $value) {
                DetailEvent::create([
                    'event_id' => $event->id,
                    'label' => $label,
                    'value' => $value,
                ]);
            }

            $timelinePreset = [
                'Registrasi Ulang Peserta' => ['start_hour' => 8, 'duration' => 1],   // 08:00 - 09:00
                'Pembukaan oleh Dekan / Rektor' => ['start_hour' => 9, 'duration' => 1], // 09:00 - 10:00
                'Sesi Inti (Penyampaian Materi)' => ['start_hour' => 10, 'duration' => 3], // 10:00 - 13:00
                'Sesi Tanya Jawab & Istirahat' => ['start_hour' => 13, 'duration' => 1],  // 13:00 - 14:00
                'Penutupan & Pembagian Doorprize' => ['start_hour' => 14, 'duration' => 1], // 14:00 - 15:00
            ];

            $baseDate = Carbon::parse($event->start_date);

            foreach ($timelinePreset as $description => $timeInfo) {

                $startTime = (clone $baseDate)->setTime($timeInfo['start_hour'], 0, 0);
                
                $endTime = (clone $startTime)->addHours($timeInfo['duration']);

                Timeline::create([
                    'event_id' => $event->id,
                    'description' => $description,
                    'start' => $startTime,
                    'end' => $endTime,
                ]);
            }
        }
    }
}
