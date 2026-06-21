<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestPemakaian extends Model
{
    use HasFactory;

    /*
    ========================================
    Nama Table
    ========================================
    */
    protected $table = 'request_pemakaian';

    /*
    ========================================
    Primary Key Custom
    ========================================
    */
    protected $primaryKey = 'id_request_pemakaian';

    public $incrementing = true;
    protected $keyType = 'int';

    /*
    ========================================
    Fillable Fields
    ========================================
    */
    protected $fillable = [
        'tanggal_request',
        'id_barang_pakai',
        'jumlah_pemakaian',
        'keterangan_pemakaian',
        'id_department',
        'id_user',
        'file_request',
        'status_approval',
        'catatan_manager',
    ];

    /*
    ========================================
    Casts
    ========================================
    */
    protected $casts = [
        'tanggal_request' => 'date:Y-m-d',
        'jumlah_pemakaian' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generates e.g. "PMK-20260621-0001"
            $latest = static::whereDate('created_at', today())->count() + 1;
            $model->kode_request_pemakaian = 'PMK-' . date('Ymd') . '-' . str_pad($latest, 4, '0', STR_PAD_LEFT);
        });
    }

    /*
    ========================================
    Relasi ke Aset Barang Pakai
    ========================================
    */
    public function barangPakai()
    {
        return $this->belongsTo(
            AsetBarangPakai::class,
            'id_barang_pakai',
            'id_barang_pakai'
        );
    }

    /*
    ========================================
    Relasi ke Department
    ========================================
    */
    public function department()
    {
        return $this->belongsTo(
            Department::class,
            'id_department',
            'id_department'
        );
    }

    /*
    ========================================
    Relasi ke User (Staff Pengaju)
    ========================================
    */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }
}