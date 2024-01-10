<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "john@admin.com",
            "password" => Hash::make('password'),
            "phone" => "998998889999"
        ]);
    }
}
