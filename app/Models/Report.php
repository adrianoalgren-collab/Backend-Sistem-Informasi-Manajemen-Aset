<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use SoftDeletes;

    protected $table = 'reports';
    protected $primaryKey = 'id_report';

    protected $fillable = [
        'judul',
        'tanggal',
        'status',
        'file_path',
        'user_id',
    ];

    // Sembunyikan path asli file dari JSON response
    protected $hidden = ['file_path'];

    // Tambahkan URL file ke setiap JSON response
    protected $appends = ['file_url'];

    protected $casts = [
        'tanggal'    => 'date:Y-m-d',
        'status'     => 'string',
        'deleted_at' => 'datetime',
    ];

    // ── RELASI ──────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ── ACCESSOR ─────────────────────────────────────────

    /**
     * URL publik file — support local & cloud storage (S3, dll).
     * Storage::url() otomatis menyesuaikan driver di filesystems.php.
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path
            ? url('storage/' . $this->file_path)
            : null;
    }

    // ── QUERY SCOPES ──────────────────────────────────────

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDisetujui($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }
}