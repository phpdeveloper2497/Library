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
        $user = User::create([
            "first_name" => "Admin",
            "last_name" => "Admin",
            "email" => "admin@admin.com",
            "password" => Hash::make('password'),
            "phone" => "998908829999"
        ]);
        $user->assignRole('admin');

        $user = User::create([
            "first_name" => "John",
            "last_name" => "Doe",
            "email" => "john@john.com",
            "password" => Hash::make('password'),
            "phone" => "998997077212"
        ]);
        $user->assignRole('chief_librarian');

         $user = User::create([
            "first_name" => "Akmal",
            "last_name" => "Akromov",
            "email" => "librarian@librarian.com",
            "password" => Hash::make('password'),
            "phone" => "99891089597"
        ]);
        $user->assignRole('librarian');
    }
}
