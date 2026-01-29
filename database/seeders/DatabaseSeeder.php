<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PetaniSeeder::class,
            LadangSeeder::class,
            KendaraanSeeder::class,
            PembelianSeeder::class,
            PanenSeeder::class,
            PengemasanSeeder::class,
            PengirimanSeeder::class,
            LogTrackingSeeder::class,
            CuacaSeeder::class,
        ]);
    }
}
