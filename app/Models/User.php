<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // ======================================================
    // === Mass Assignment
    // ======================================================
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_role',
        'id_department',
    ];

    // ======================================================
    // === Hidden Attributes
    // ======================================================
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ======================================================
    // === Casts
    // ======================================================
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ======================================================
    // === Relationships
    // ======================================================

    /**
     * Relasi ke Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    /**
     * Relasi ke Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department', 'id_department');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'user_report');
    }

    /**
     * Relasi ke request perbaikan
     */
    public function requestPerbaikan()
    {
        return $this->hasMany(\App\Models\RequestPerbaikan::class, 'staff_id', 'id');
    }

    public function kendaraan()
    {
        return $this->hasMany(
            AsetKendaraan::class,
            'user_kendaraan',
            'id'
        );
    }
}