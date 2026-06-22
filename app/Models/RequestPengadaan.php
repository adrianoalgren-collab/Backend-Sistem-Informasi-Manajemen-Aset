<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RequestPengadaan extends Model
{
    use HasFactory;

    /*
    ========================================
    Nama Table
    ========================================
    */
    protected $table = 'request_pengadaan';

    /*
    ========================================
    Primary Key Custom
    ========================================
    */
    protected $primaryKey = 'id_request_pengadaan';

    public $incrementing = true;
    protected $keyType = 'int';

    /*
    ========================================
    Fillable Fields
    ========================================
    */
    protected $fillable = [
        'tanggal_request',
        'nama_pengadaan',
        'kategori_pengadaan',
        'id_department',
        'id_user',
        'file_request',
        'status_approval',
        'catatan_manager',
        'jenis_aset',
        'id_barang_pakai',
        'jumlah_pengadaan',
    ];

    /*
    ========================================
    Casts
    ========================================
    */
    protected $casts = [
        'tanggal_request' => 'date',
        'jumlah_pengadaan' => 'integer',
    ];

    /*
    ========================================
    Appends — field tambahan yang ikut di JSON
    ========================================
    */
    protected $appends = ['file_request_url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generates e.g. "REQ-20260519-0001"
            $latest = static::whereDate('created_at', today())->count() + 1;
            $model->kode_request_pengadaan = 'REQ-' . date('Ymd') . '-' . str_pad($latest, 4, '0', STR_PAD_LEFT);
        });
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
    Accessor: URL lengkap untuk file request
    ========================================
    */
    public function getFileRequestUrlAttribute()
    {
        return $this->file_request
            ? Storage::disk('public')->url($this->file_request)
            : null;
    }
}