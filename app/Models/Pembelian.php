<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id',
        'user_id',
        'tanggal_beli',
        'harga_per_kg',
        'total_kg',
        'total_harga',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
