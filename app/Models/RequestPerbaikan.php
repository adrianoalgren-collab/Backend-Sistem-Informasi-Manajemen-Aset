<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RequestPerbaikan extends Model
{
    use HasFactory;

    protected $table      = 'request_perbaikan';
    protected $primaryKey = 'id_request_perbaikan'; // ← fix: tanpa ini find() pakai 'id'

    protected $fillable = [
        'id_operasional',
        'id_kodebarang',
        'id_user',
        'tanggal_request',
        'file_request',
        'status_request',
        'catatan_admin',
    ];

    protected $appends = ['file_request_url'];

    // ── Relasi ke aset_operasional ──
    public function aset()
    {
        return $this->belongsTo(
            \App\Models\AsetOperasional::class,
            'id_operasional',
            'id_operasional'
        );
    }

    // ── Relasi ke kode_barang ──
    public function kodeBarang()
    {
        return $this->belongsTo(
            \App\Models\KodeBarang::class,
            'id_kodebarang',
            'id_kodebarang'
        );
    }

    // ── Relasi ke users ──
    public function user()
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'id_user',
            'id'
        );
    }

    // ── Accessor URL file ──
    public function getFileRequestUrlAttribute()
    {
        return $this->file_request
            ? asset('storage/' . $this->file_request)
            : null;
    }
}