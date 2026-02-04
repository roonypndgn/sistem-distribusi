<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'user_id',
        'tanggal_kerja',
        'jam_masuk',
        'jam_keluar',
        'jam_kerja_total',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
