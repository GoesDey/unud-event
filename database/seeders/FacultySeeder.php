<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            'Fakultas Ilmu Budaya',
            'Fakultas Kedokteran',
            'Fakultas Hukum',
            'Fakultas Teknik',
            'Fakultas Ekonomi dan Bisnis',
            'Fakultas Pertanian',
            'Fakultas Peternakan',
            'Fakultas Matematika dan Ilmu Pengetahuan Alam',
            'Fakultas Kedokteran Hewan',
            'Fakultas Teknologi Pertanian',
            'Fakultas Pariwisata',
            'Fakultas Ilmu Sosial dan Ilmu Politik',
            'Fakultas Kelautan dan Perikanan',        
        ];

        foreach ($faculties as $faculty) {
            Faculty::create([
                'name' => $faculty,
            ]);
        }
    }
}
