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
            'Lomba' => 'Tunjukkan kemampuanmu dan bersaing dengan mahasiswa lain dalam berbagai jenis kompetisi akademik dan non-akademik.' , 
            'Seminar' => 'Dapatkan ilmu baru dan diskusikan tren topik hangat langsung bersama para pakar dan praktisi profesional secara tatap muka.',
            'Pengabdian' => 'Berikan dampak positif dengan mengikuti program pengabdian yang membantu masyarakat sekitar kampus.',
            'Workshop' => 'Asah keterampilan teknis dan praktikkan keahlian baru secara langsung melalui sesi pelatihan yang intensif dan aplikatif.',
            'Webinar' => 'Perluas wawasan melalui sesi pembelajaran interaktif dengan pembicara berpengalaman dari berbagai bidang industri.',
        ];

        foreach ($types as $type => $value) {
            EventType::create([
                'name' => $type,
                'description' => $value,
            ]);
        }
    }
}
