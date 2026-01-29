<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengemasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'panen_id',
        'tanggal_kemas',
        'jumlah_paket',
        'berat_per_paket',
    ];

    public function panen()
    {
        return $this->belongsTo(Panen::class);
    }
}
