<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AsetOperasional;

class KodeBarang extends Model
{
    use HasFactory;

    /*
    =====================================================
    TABLE
    =====================================================
    */
    protected $table = 'kode_barang';

    /*
    =====================================================
    PRIMARY KEY
    =====================================================
    */
    protected $primaryKey = 'id_kodebarang';

    /*
    =====================================================
    MASS ASSIGNMENT
    =====================================================
    */
    protected $fillable = [
        'kode_barang',
        'id_operasional',
        'kondisi_asetoperasional',
        'lokasi_asetoperasional',
        'foto_asetoperasional',
    ];

    /*
    =====================================================
    RELATIONSHIP
    =====================================================
    */

    // Kode Barang belongs to Aset Operasional
    public function asetOperasional()
    {
        return $this->belongsTo(
            AsetOperasional::class,
            'id_operasional',
            'id_operasional'
        );
    }
}