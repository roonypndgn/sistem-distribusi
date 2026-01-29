<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petani extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_petani',
        'alamat',
        'no_hp',
    ];

    public function ladangs()
    {
        return $this->hasMany(Ladang::class);
    }
}
