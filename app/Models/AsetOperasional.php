<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\KodeBarang;

class AsetOperasional extends Model
{
    use HasFactory;

    /*
    ========================================
    TABLE
    ========================================
    */
    protected $table = 'aset_operasional';

    /*
    ========================================
    PRIMARY KEY
    ========================================
    */
    protected $primaryKey = 'id_operasional';

    /*
    ========================================
    MASS ASSIGNMENT
    ========================================
    */
    protected $fillable = [
        'nama_asetoperasional',
        'id_manufacturer',
    ];

    /*
    ========================================
    RELASI KE MANUFACTURER
    ========================================
    */
    public function manufacturer()
    {
        return $this->belongsTo(
            Manufacturer::class,
            'id_manufacturer',
            'id_manufacturer'
        );
    }

    /*
    ========================================
    RELASI KE KODE BARANG
    1 ASET = BANYAK KODE BARANG
    ========================================
    */
    public function kodeBarang()
    {
        return $this->hasMany(
            KodeBarang::class,
            'id_operasional',
            'id_operasional'
        );
    }

    /*
    ========================================
    RELASI KE REQUEST PERBAIKAN
    ========================================
    */
    public function requestPerbaikan()
    {
        return $this->hasMany(
            \App\Models\RequestPerbaikan::class,
            'id_operasional',
            'id_operasional'
        );
    }
}