<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

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
}