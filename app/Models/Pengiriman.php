<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';

    protected $fillable = [
        'tanggal_kirim',
        'user_id',
        'kendaraan_id',
        'rute',
        'tujuan_akhir',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function logTrackings()
{
    return $this->hasMany(LogTraking::class, 'pengiriman_id');
}
}
