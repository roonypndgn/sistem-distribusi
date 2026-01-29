<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panen extends Model
{
    use HasFactory;

    protected $fillable = [
        'ladang_id',
        'tanggal_panen',
        'jumlah_kg',
        'kualitas',
    ];

    public function ladang()
    {
        return $this->belongsTo(Ladang::class);
    }
}
