<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 10 user dummy (kalau perlu)
        // User::factory(10)->create();

        // Buat 1 user test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Panggil seeder untuk admin
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}
