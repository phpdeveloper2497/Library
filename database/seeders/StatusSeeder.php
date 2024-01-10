<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Status::create([
            'name' => [
               'en' => 'client registered',
               'ru' => 'клиент зарегистрирован',
               'uz' => 'foydalanuvchi ro\'yhatdan o\'tdi',
                ],
            'for' =>'client',
            'code' =>'registered'

        ]);

        Status::create([
            'name' => [
                'en' => 'the reader received the books',
                'ru' => 'читател получил книги',
                'uz' => 'o\'quvchi kitoblarni oldi',
            ],
            'for' =>'order',
            'code' => 'take'

        ]);

        Status::create([
            'name' => [
                'en' => 'the reader returned the books',
                'ru' => 'читател вернул книги',
                'uz' => 'o\'quvchi kitoblarni qaytardi',
            ],
            'for' =>'order',
            'code' => 'closed'
        ]);

        Status::create([
            'name' => [
                'en' => 'the reader didn\'t returned the books',
                'ru' => 'читател не вернул книги',
                'uz' => 'o\'quvchida qaytarilmagan kitoblar bor',
            ],
            'for' =>'order',
            'code' => 'didn\'t return',
        ]);
    }
}
