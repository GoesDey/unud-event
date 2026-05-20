<?php

namespace Database\Seeders;

use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = Faculty::with('majors')->get();

        foreach ($faculties as $faculty) {
            //DPM Super Admin
            User::factory()->create([
                'name' => 'DPM SA ' . $faculty->name,
                'username' => 'dpm-sa-' . Str::slug($faculty->name),
                'email' => 'Dpm-Sa-.' . Str::slug($faculty->name) . '@gmail.com',
                'password' => Hash::make('dpm-sa-' . $faculty->name),
                'role' => 'super_admin',
                'faculty_id' => $faculty->id,
                'major_id' => null,
            ]);
            //DPM Admin
            User::factory()->create([
                'name' => 'DPM A ' . $faculty->name,
                'username' => 'dpm-a-' . Str::slug($faculty->name),
                'email' => 'Dpm-a-.' . Str::slug($faculty->name) . '@gmail.com',
                'password' => Hash::make('dpm-a-' . $faculty->name),
                'role' => 'admin',
                'faculty_id' => $faculty->id,
                'major_id' => null,
            ]);
            //BEM Admin
            User::factory()->create([
                'name' => 'BEM ' . $faculty->name,
                'username' => 'bem-' . Str::slug($faculty->name),
                'email' => 'Bem-' . Str::slug($faculty->name) . '@gmail.com',
                'password' => Hash::make('bem-' . $faculty->name),
                'role' => 'admin',
                'faculty_id' => $faculty->id,
                'major_id' => null,
            ]);

            foreach ($faculty->majors as $major) {
                $passAdmin = 'hima'. $major->name;
                $majorSlug = Str::slug($major->name);
                User::factory()->create([
                    'name' => 'Hima ' . $major->name,
                    'username' => 'hima-' . $majorSlug,
                    'email' => 'Hima.' . $majorSlug . '@gmail.com',
                    'role' => 'admin',
                    'password' => Hash::make($passAdmin),
                    'faculty_id' => $faculty->id,
                    'major_id' => $major->id,
                ]);
                
            }
        }
    }
}
