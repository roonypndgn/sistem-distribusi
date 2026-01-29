<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petani;

class PetaniSeeder extends Seeder
{
    public function run(): void
    {
        Petani::create([
            'nama_petani' => 'Budi Ginting',
            'no_telepon' => '081234567890',
            'alamat' => 'Desa Gundaling, Berastagi',
        ]);
    }
}
