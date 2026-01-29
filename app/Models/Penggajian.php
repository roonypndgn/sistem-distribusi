<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajians';

    protected $fillable = [
        'user_id',
        'periode_gaji',
        'total_upah_dasar',
        'total_insentif',
        'total_potongan',
        'status_pembayaran',
        'tanggal_transfer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
