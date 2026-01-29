<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ladang extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id',
        'lokasi',
        'luas_ladang',
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
}
