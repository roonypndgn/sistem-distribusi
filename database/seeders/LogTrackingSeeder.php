<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogTracking;

class LogTrackingSeeder extends Seeder
{
    public function run(): void
    {
        LogTracking::create([
            'pengiriman_id' => 1,
            'timestamp_log' => now(),
            'koordinat_gps' => '-3.2000,98.6000',
            'status' => 'Dalam Perjalanan',
            'note'=>'ok',
            'location_description'=>'dekat tol',
        ]);
    }
}
