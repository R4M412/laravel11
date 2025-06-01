<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // cari user dengan email ini
            [
                'name' => 'Admin',
                'password' => Hash::make('1'), // password: 1
            ]
        );
    }
}
