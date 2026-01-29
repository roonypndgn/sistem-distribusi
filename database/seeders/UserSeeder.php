<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Pusat',
            'email' => 'pusat@mdh.co.id',
            'password' => Hash::make('password'),
            'role' => 'pusat',
        ]);

        User::create([
            'name' => 'Manajer Lapangan',
            'email' => 'manajer@mdh.co.id',
            'password' => Hash::make('password'),
            'role' => 'manajer',
        ]);

        User::create([
            'name' => 'Karyawan Packing',
            'email' => 'karyawan@mdh.co.id',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);

        User::create([
            'name' => 'Sopir Logistik',
            'email' => 'sopir@mdh.co.id',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);
    }
}
