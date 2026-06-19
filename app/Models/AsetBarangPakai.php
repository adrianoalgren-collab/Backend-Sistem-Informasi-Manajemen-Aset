<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;

class AsetBarangPakai extends Model
{
    use HasFactory;

    protected $table = 'aset_barang_pakai';

    protected $primaryKey = 'id_barang_pakai';

    protected $fillable = [
        'kode_asetbarangpakai',
        'nama_asetbarangpakai',
        'kategori_asetbarangpakai',
        'kondisi_asetbarangpakai',
        'lokasi_asetbarangpakai',
        'stok_asetbarangpakai',
        'satuan_asetbarangpakai',
        'foto_asetbarangpakai',
        'id_manufacturer',
    ];

    /**
     * Relasi ke Manufacturer
     */
    public function manufacturer()
    {
        return $this->belongsTo(
            Manufacturer::class,
            'id_manufacturer',
            'id_manufacturer'
        );
    }
}