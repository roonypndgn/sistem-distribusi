<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        Kendaraan::create([
            'plat_nomor' => 'BK 1234 MD',
            'jenis_kendaraan' => 'Truk Box',
            'kapasitas_kg' => 5000,
        ]);
    }
}
