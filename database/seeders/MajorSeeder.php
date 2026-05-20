<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Fakultas Ilmu Budaya' => [
                'Sastra Indonesia', 'Sastra Inggris', 'Jawa Kuno', 'Sastra Bali', 
                'Sastra Jepang', 'Sejarah', 'Arkeologi', 'Antropologi'
            ],
            'Fakultas Kedokteran' => [
                'Kedokteran Umum', 'Keperawatan', 'Psikologi', 
                'Sarjana Kesehatan Masyarakat', 'Fisioterapi', 'Fisiologi Olahraga'
            ],
            'Fakultas Hukum' => [
                'Ilmu Hukum'
            ],
            'Fakultas Teknik' => [
                'Teknik Sipil', 'Teknik Mesin', 'Teknik Elektro', 
                'Teknik Arsitektur', 'Teknologi Informasi', 'Teknik Lingkungan', 'Teknik Industri'
            ],
            'Fakultas Ekonomi dan Bisnis' => [
                'Sarjana Ekonomi', 'Sarjana Manajemen', 'Sarjana Akuntansi'
            ],
            'Fakultas Pertanian' => [
                'Agroekoteknologi', 'Agribisnis', 'Arsitektur Pertamanan', 'Arsitektur Lanskap'
            ],
            'Fakultas Peternakan' => [
                'Peternakan'
            ],
            'Fakultas Matematika dan Ilmu Pengetahuan Alam' => [
                'Matematika', 'Kimia', 'Fisika', 'Biologi', 'Farmasi', 'Informatika'
            ],
            'Fakultas Kedokteran Hewan' => [
                'Kedokteran Hewan'
            ],
            'Fakultas Teknologi Pertanian' => [
                'Teknologi Pangan', 'Teknik Pertanian dan Biosistem', 'Teknologi Industri Pertanian'
            ],
            'Fakultas Pariwisata' => [
                'Destinasi Wisata', 'Industri Perjalanan Wisata'
            ],
            'Fakultas Ilmu Sosial dan Ilmu Politik' => [
                'Ilmu Sosiologi', 'Hubungan Internasional', 'Administrasi Publik', 
                'Ilmu Politik', 'Ilmu Komunikasi'
            ],
            'Fakultas Kelautan dan Perikanan' => [
                'Ilmu Kelautan', 'Manajemen Sumberdaya Perairan'
            ],
        ];

        foreach ($data as $facultyName => $majorName) {
            $faculty = Faculty::where('name', $facultyName)->first();

            if ($facultyName) {
                foreach ($majorName as $major) {
                    Major::create([
                        'name' => $major,
                        'faculty_id' => $faculty->id
                    ]);
                }
            } 
        }
    }
}
