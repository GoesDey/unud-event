<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Hackaton',
            'Big Data Analytic',
            'Web Development',
            'UI/UX Design',
            'Business Plan',
            'Essay',
            'Karya Tulis Ilmiah',
            'Debat',
            'Olimpiade Matematika',
            'Olimpiade Fisika',
            'Olimpiade Kimia',
            'Fotografi',
            'Videografi',
            'Dance',
            'Konser',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
