<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user
        User::firstOrCreate(
            ['email' => 'admin@spk.local'],
            [
                'name' => 'Admin SPK',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Seed kriteria
        $this->call(KriteriaSeeder::class);

        // Buat siswa contoh
        User::factory(5)->create();
    }
}
