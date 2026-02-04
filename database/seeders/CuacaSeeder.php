<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuaca;

class CuacaSeeder extends Seeder
{
    public function run(): void
    {
        Cuaca::create([
            'ladang_id' => 1,
            'tanggal' => now(),
            'curah_hujan' => 'Sedang',
            'laporan_gangguan' => 'Hujan ringan, panen sedikit tertunda',
            'sumber_data' => 'manual',
            'catatan'=>'ok',
            'bukti_foto'=>'bukti.jpg',
        ]);
    }
}
