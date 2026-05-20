<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            FacultySeeder::class,
            MajorSeeder::class,
            UserSeeder::class,
            EventTypeSeeder::class,
            CategorySeeder::class,
            ParticipantSeeder::class,      // 1. Jalankan master peserta ('SD', 'SMP', dll)
            EventSeeder::class,            // 2. Jalankan pembuatan 5 event
            EventCategorySeeder::class,    // 3. Hubungkan event dengan kategori
            EventParticipantSeeder::class, // 4. Hubungkan event dengan target peserta (Paling akhir)
        ]);
    }
}
