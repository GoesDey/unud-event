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
            ParticipantSeeder::class,      // 1. Jalankan master peserta
            EventSeeder::class,            // 2. Jalankan pembuatan 15 event + detail + timeline + pivot kategori/peserta
        ]);
    }
}
