<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengiriman_id',
        'timestamp_log',
        'koordinat_gps',
        'status',
        'note',
        'location_description'
    ];

    protected $casts = [
        'timestamp_log' => 'datetime'
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class);
    }
}