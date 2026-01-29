<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User untuk setiap role
        $users = [
            [
                'name' => 'Admin Pusat Jakarta',
                'email' => 'admin@marduaholong.com',
                'password' => Hash::make('password123'),
                'role' => 'pusat',
            ],
            [
                'name' => 'Manajer Lapangan Berastagi',
                'email' => 'manajer@marduaholong.com',
                'password' => Hash::make('password123'),
                'role' => 'manajer',
            ],
            [
                'name' => 'Karyawan Packing',
                'email' => 'karyawan@marduaholong.com',
                'password' => Hash::make('password123'),
                'role' => 'karyawan',
            ],
            [
                'name' => 'Petani Jeruk',
                'email' => 'petani@marduaholong.com',
                'password' => Hash::make('password123'),
                'role' => 'petani',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $this->call([
            // Seeders lainnya jika ada
        ]);
    }
}