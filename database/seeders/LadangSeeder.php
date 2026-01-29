<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ladang;

class LadangSeeder extends Seeder
{
    public function run(): void
    {
        Ladang::create([
            'petani_id' => 1,
            'nama_ladang' => 'Ladang Jeruk Gundaling',
            'koordinat_gps' => '-3.1896,98.5089',
            'luas_ladang' => 2.5,
        ]);
    }
}
