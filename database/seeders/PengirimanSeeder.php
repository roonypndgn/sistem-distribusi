<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengiriman;

class PengirimanSeeder extends Seeder
{
    public function run(): void
    {
        Pengiriman::create([
            'tanggal_kirim' => now(),
            'user_id' => 4, // sopir
            'kendaraan_id' => 1,
            'rute' => 'Berastagi - Medan - Jakarta',
            'tujuan_akhir' => 'Gudang Jakarta',
            'status' => 'dikirim',
            'catatan'=>'ok',
        ]);
    }
}
