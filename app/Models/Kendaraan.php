<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plat_nomor',
        'jenis_kendaraan',
        'kapasitas_kg',
        'catatan',
        'status',
    ];

    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class);
    }
}
