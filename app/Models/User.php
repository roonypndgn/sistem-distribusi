<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Scope untuk filter berdasarkan role
    public function scopeByRole($query, $role)
    {
        return $query->where('role', $role);
    }

    // Helper method untuk check role
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class);
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class);
    }
    public function absensis()
{
    return $this->hasMany(Absensi::class);
}

public function penggajians()
{
    return $this->hasMany(Penggajian::class);
}

}