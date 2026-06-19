<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KendaraanHistory extends Model
{
    use SoftDeletes;

    /*
    =========================================
    Table & Primary Key
    =========================================
    */
    protected $table = 'kendaraan_history';

    // ✅ Sesuai migration: $table->id() → kolom 'id'
    protected $primaryKey = 'id';

    /*
    =========================================
    Fillable
    =========================================
    */
    protected $fillable = [
        'id_kendaraan',
        'user_id',        // ✅ Sesuai migration: $table->foreignId('user_id')
        'tanggal_assign',
        'tanggal_selesai',
    ];

    /*
    =========================================
    Casts
    =========================================
    */
    protected $casts = [
        'id_kendaraan'    => 'integer',
        'user_id'         => 'integer',  // ✅ Sesuai migration
        'tanggal_assign'  => 'datetime',
        'tanggal_selesai' => 'datetime',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'deleted_at'      => 'datetime',
    ];

    /*
    =========================================
    Relasi ke Kendaraan
    =========================================
    */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(
            AsetKendaraan::class,
            'id_kendaraan',
            'id_kendaraan'
        );
    }

    /*
    =========================================
    Relasi ke User / Driver
    =========================================
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',  // ✅ Sesuai migration
            'id'
        );
    }
}