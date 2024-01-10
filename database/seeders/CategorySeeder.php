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
        Category::create([
            "name" => [
                'en' => 'Classic',
                'ru' => 'Классический',
                'uz' => 'Klassik',
            ],
        ]);
        Category::create([
            "name" => [
                'en' => 'Drama',
                'ru' => 'Драма',
                'uz' => 'Drama',
            ],
        ]);
        Category::create([
            "name" => [
                'en' => 'Fantasy',
                'ru' => 'Фантазия',
                'uz' => 'Fantaziya',
            ],

        ]);
        Category::create([
            "name" => [
                'en' => 'Humor',
                'ru' => 'Юмор',
                'uz' => 'Hazil',
            ],
        ]);
        Category::create([
            "name" => [
                'en' => 'Crime and Detective',
                'ru' => 'Криминал и детектив',
                'uz' => 'Jinoyat va detektiv',
            ],
        ]);
        Category::create([
            "name" => [
                'en' => 'Comic and Graphic Novel',
                'ru' => 'Комикс и графический роман',
                'uz' => 'Komiks va grafik roman',
            ],
        ]);
    }
}
