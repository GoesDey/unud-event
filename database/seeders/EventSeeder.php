<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Timeline;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUsers = User::where('role', 'admin')->get(); 

        $categories = Category::all();
        $eventTypes = EventType::all();

        $eventMapping = [
            'Lomba' => [
                ['name' => 'Udayana Hackathon: Inovasi Digital Mahasiswa', 'location' => 'offline', 'price' => 50000],
                ['name' => 'Olimpiade Karya Tulis Ilmiah Tingkat Nasional', 'location' => 'online', 'price' => 0],
            ],
            'Seminar' => [
                ['name' => 'Seminar Nasional: Eksistensi Budaya Bali di Era Gen-Z', 'location' => 'offline', 'price' => 35000],
                ['name' => 'Talkshow Kewirausahaan: Merintis Bisnis Sejak Kuliah', 'location' => 'offline', 'price' => 20000],
            ],
            'Pengabdian' => [
                ['name' => 'Udayana Mengabdi: Program Mengajar di Desa Binaan', 'location' => 'offline', 'price' => 0],
                ['name' => 'Bakti Sosial: Cek Kesehatan & Donor Darah Massal', 'location' => 'offline', 'price' => 0],
            ],
            'Workshop' => [
                ['name' => 'Workshop UI/UX: Membangun Aplikasi Ramah Pengguna', 'location' => 'offline', 'price' => 75000],
                ['name' => 'Pelatihan Web Development Menggunakan Laravel', 'location' => 'online', 'price' => 50000],
            ],
            'Webinar' => [
                ['name' => 'Webinar Karir: Rahasia Lolos Interview Perusahaan Multinasional', 'location' => 'online', 'price' => 0],
                ['name' => 'Webinar Beasiswa: Tips Jitu Tembus LPDP 2026', 'location' => 'online', 'price' => 0],
            ],
        ];

        foreach ($eventTypes as $type) {
            if (isset($eventMapping[$type->name])) {
                
                // Looping 2 event di dalam setiap tipe
                foreach ($eventMapping[$type->name] as $item) {
                    
                    $randomAdmin = $adminUsers->random();
                    $startDate = Carbon::now()->addDays(rand(7, 30)); 

                    $event = Event::create([
                        'user_id' => $randomAdmin->id,
                        'event_type_id' => $type->id,
                        'name' => $item['name'],
                        'description' => 'Ini adalah deskripsi dummy untuk acara ' . $item['name'] . '. Acara ini diselenggarakan untuk meningkatkan kapasitas mahasiswa Universitas Udayana.',
                        'faculty' => $randomAdmin->faculty ? $randomAdmin->faculty->name : null,
                        'major' => $randomAdmin->major ? $randomAdmin->major->name : null,
                        'instance' => $randomAdmin->major ? 'Himpunan Mahasiswa ' . $randomAdmin->major->name : 'Badan Eksekutif Mahasiswa Unud',
                        'picture' => 'https://placehold.co/900x1200/png?text=Event+Udayana',
                        'location' => $item['location'],
                        'price' => $item['price'],
                        'start_date' => $startDate->toDateString(),
                        'end_date' => $startDate->copy()->addDays(rand(0, 2))->toDateString(),
                    ]);

                    $event->categories()->attach(
                        $categories->random(rand(1, 3))->pluck('id')->toArray()
                    );

                    // DetailEvent
                    $detailsPreset = [
                        'Narasumber' => fake()->name() . ' (' . fake()->jobTitle() . ')',
                        'Benefit' => 'Sertifikat Nasional, SKP, Merchandise Kit',
                        'Contact Person' => fake()->name() . ' (08' . fake()->numerify('########') . ')',
                        'Syarat & Ketentuan' => 'Membawa KTM aktif dan mengenakan almamater Universitas Udayana.',
                    ];

                    foreach ($detailsPreset as $label => $value) {
                        DetailEvent::create([
                            'event_id' => $event->id,
                            'label' => $label,
                            'value' => $value,
                        ]);
                    }

                    // Buat Data Timeline
                    $timelinePreset = [
                        'Registrasi Peserta' => ['start_hour' => 8, 'duration' => 1],
                        'Pembukaan Acara' => ['start_hour' => 9, 'duration' => 1],
                        'Sesi Inti Acara' => ['start_hour' => 10, 'duration' => 3],
                        'Tanya Jawab & Penutup' => ['start_hour' => 13, 'duration' => 1],
                    ];

                    foreach ($timelinePreset as $desc => $timeInfo) {
                        $startTL = (clone $startDate)->setTime($timeInfo['start_hour'], 0, 0);
                        $endTL = (clone $startTL)->addHours($timeInfo['duration']);

                        Timeline::create([
                            'event_id' => $event->id,
                            'description' => $desc,
                            'start' => $startTL,
                            'end' => $endTL,
                        ]);
                    }
                }
            }
        }
    }
}