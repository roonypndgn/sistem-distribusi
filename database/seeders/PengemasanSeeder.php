<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengemasan;

class PengemasanSeeder extends Seeder
{
    public function run(): void
    {
        Pengemasan::create([
            'panen_id' => 1,
            'batch_pengemasan' => 'KEMAS-001',
            'jumlah_kemasan' => 100,
            'kualitas_pengemasan' => 'baik',
            'tanggal_kemas' => now(),
            'catatan'=>'ok',
        ]);
    }
}
