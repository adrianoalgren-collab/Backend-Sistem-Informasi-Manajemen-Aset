<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\AsetOperasional;
use App\Models\AsetKendaraan;
use App\Models\AsetBarangPakai;

class Manufacturer extends Model
{
    protected $table = 'manufacturers';

    protected $primaryKey = 'id_manufacturer';

    protected $fillable = [
        'nama_manufacturer',
        'email_manufacturer',
        'telfon_manufacturer',
    ];

    /*
    ========================================
    Relasi ke Aset Operasional
    ========================================
    */
    public function asetOperasional(): HasMany
    {
        return $this->hasMany(
            AsetOperasional::class,
            'id_manufacturer',
            'id_manufacturer'
        );
    }

    /*
    ========================================
    Relasi ke Aset Kendaraan
    ========================================
    */
    public function kendaraan(): HasMany
    {
        return $this->hasMany(
            AsetKendaraan::class,
            'id_manufacturer',
            'id_manufacturer'
        );
    }

    /*
    ========================================
    Relasi ke Aset Barang Pakai
    ========================================
    */
    public function asetBarangPakai(): HasMany
    {
        return $this->hasMany(
            AsetBarangPakai::class,
            'id_manufacturer',
            'id_manufacturer'
        );
    }
}