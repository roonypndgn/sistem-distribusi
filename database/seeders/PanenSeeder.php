<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Panen;

class PanenSeeder extends Seeder
{
    public function run(): void
    {
        Panen::create([
            'pembelian_id' => 1,
            'batch_panen' => 'PANEN-001',
            'tanggal_panen' => now(),
            'kualitas_jeruk' => 'A',
            'lokasi_gps' => '-3.1896,98.5089',
        ]);
    }
}
