<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AsetKendaraan extends Model
{
    use SoftDeletes;

    /*
    =========================================
    Table & Primary Key
    =========================================
    */
    protected $table = 'aset_kendaraan';

    protected $primaryKey = 'id_kendaraan';

    /*
    =========================================
    Fillable
    =========================================
    */
    protected $fillable = [
        'kode_kendaraan',
        'nama_kendaraan',
        'id_manufacturer',
        'plat_kendaraan',
        'kondisi_kendaraan',
        'id_user',
    ];

    /*
    =========================================
    Casts
    =========================================
    */
    protected $casts = [
        'id_manufacturer' => 'integer',
        'id_user'         => 'integer',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'deleted_at'      => 'datetime',
    ];

    /*
    =========================================
    Enum Values (kondisi_kendaraan)
    =========================================
    */
    const KONDISI_BAIK         = 'baik';
    const KONDISI_RUSAK_RINGAN = 'rusak_ringan';
    const KONDISI_RUSAK_BERAT  = 'rusak_berat';
    const KONDISI_TIDAK_AKTIF  = 'tidak_aktif';

    /**
     * Mengembalikan daftar nilai kondisi yang valid.
     * Berguna untuk validasi (Rule::in, in_array, dsb).
     */
    public static function kondisiOptions(): array
    {
        return [
            self::KONDISI_BAIK,
            self::KONDISI_RUSAK_RINGAN,
            self::KONDISI_RUSAK_BERAT,
            self::KONDISI_TIDAK_AKTIF,
        ];
    }

    /**
     * Mengembalikan pasangan nilai => label kondisi.
     * Berguna untuk dropdown/select di form dan tampilan UI.
     */
    public static function kondisiLabels(): array
    {
        return [
            self::KONDISI_BAIK         => 'Baik',
            self::KONDISI_RUSAK_RINGAN => 'Rusak Ringan',
            self::KONDISI_RUSAK_BERAT  => 'Rusak Berat',
            self::KONDISI_TIDAK_AKTIF  => 'Tidak Aktif',
        ];
    }

    /*
    =========================================
    Relasi ke Manufacturer
    =========================================
    */
    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(
            Manufacturer::class,
            'id_manufacturer',
            'id_manufacturer'
        );
    }

    /*
    =========================================
    Relasi ke User / Driver
    =========================================
    */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id'
        );
    }

    /*
    =========================================
    Relasi ke History
    =========================================
    */

    /**
     * Semua history kendaraan (sudah selesai maupun aktif).
     */
    public function histories(): HasMany
    {
        return $this->hasMany(
            KendaraanHistory::class, // ✅ Nama model yang benar
            'id_kendaraan',
            'id_kendaraan'
        );
    }

    /**
     * Satu history yang sedang aktif (tanggal_selesai masih NULL).
     */
    public function activeHistory(): HasOne
    {
        return $this->hasOne(
            KendaraanHistory::class, // ✅ Nama model yang benar
            'id_kendaraan',
            'id_kendaraan'
        )->whereNull('tanggal_selesai');
    }

    /*
    =========================================
    Scopes
    =========================================
    */

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('kondisi_kendaraan', '!=', self::KONDISI_TIDAK_AKTIF);
    }

    public function scopeTersedia(Builder $query): Builder
    {
        return $query->whereNull('id_user')
                     ->where('kondisi_kendaraan', self::KONDISI_BAIK)
                     ->whereDoesntHave('activeHistory');
    }

    public function scopeByKondisi(Builder $query, string $kondisi): Builder
    {
        if (! in_array($kondisi, self::kondisiOptions(), true)) {
            throw new \InvalidArgumentException(
                "Kondisi tidak valid: \"{$kondisi}\". Kondisi yang diizinkan: "
                . implode(', ', self::kondisiOptions())
            );
        }

        return $query->where('kondisi_kendaraan', $kondisi);
    }

    /*
    =========================================
    Accessors
    =========================================
    */

    public function getIsTersediaAttribute(): bool
    {
        return is_null($this->id_user)
            && $this->kondisi_kendaraan === self::KONDISI_BAIK
            && $this->activeHistory()->doesntExist();
    }
}