<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengiriman_id',
        'status',
        'lokasi',
        'waktu',
    ];

   public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'pengiriman_id');
    }
}
