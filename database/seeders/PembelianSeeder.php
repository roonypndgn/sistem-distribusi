<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembelian;

class PembelianSeeder extends Seeder
{
    public function run(): void
    {
        Pembelian::create([
            'tanggal_beli' => now(),
            'ladang_id' => 1,
            'user_id' => 2, // manajer
            'harga_per_kg' => 7000,
            'jumlah_kg' => 1000,
            'status_verifikasi' => 'verified',
            'bukti_foto' => 'bukti/pembelian1.jpg',
        ]);
    }
}
