<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AsetBarangPakai;

class AsetBarangPakaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_asetbarangpakai' => 'ABP-001',
                'nama_asetbarangpakai' => 'Safety Helmet',
                'kategori_asetbarangpakai' => 'APD',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Gudang Utama',
                'stok_asetbarangpakai' => 120,
                'satuan_asetbarangpakai' => 'pcs',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 1,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-002',
                'nama_asetbarangpakai' => 'Safety Gloves',
                'kategori_asetbarangpakai' => 'APD',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Gudang Utama',
                'stok_asetbarangpakai' => 250,
                'satuan_asetbarangpakai' => 'pairs',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 1,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-003',
                'nama_asetbarangpakai' => 'Printer Toner',
                'kategori_asetbarangpakai' => 'ATK',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Office Supply Room',
                'stok_asetbarangpakai' => 35,
                'satuan_asetbarangpakai' => 'unit',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 2,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-004',
                'nama_asetbarangpakai' => 'Industrial Lubricant Oil',
                'kategori_asetbarangpakai' => 'Maintenance',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Workshop Area',
                'stok_asetbarangpakai' => 80,
                'satuan_asetbarangpakai' => 'liter',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 3,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-005',
                'nama_asetbarangpakai' => 'LAN Cable',
                'kategori_asetbarangpakai' => 'IT Support',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'IT Storage',
                'stok_asetbarangpakai' => 60,
                'satuan_asetbarangpakai' => 'roll',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 2,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-006',
                'nama_asetbarangpakai' => 'Safety Glasses',
                'kategori_asetbarangpakai' => 'APD',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Gudang Utama',
                'stok_asetbarangpakai' => 90,
                'satuan_asetbarangpakai' => 'pcs',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 1,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-007',
                'nama_asetbarangpakai' => 'Cleaning Chemical',
                'kategori_asetbarangpakai' => 'Utility',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Utility Room',
                'stok_asetbarangpakai' => 45,
                'satuan_asetbarangpakai' => 'liter',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 3,
            ],
            [
                'kode_asetbarangpakai' => 'ABP-008',
                'nama_asetbarangpakai' => 'A4 Paper',
                'kategori_asetbarangpakai' => 'ATK',
                'kondisi_asetbarangpakai' => 'Baik',
                'lokasi_asetbarangpakai' => 'Office Supply Room',
                'stok_asetbarangpakai' => 150,
                'satuan_asetbarangpakai' => 'ream',
                'foto_asetbarangpakai' => null,
                'id_manufacturer' => 2,
            ],
        ];

        foreach ($data as $item) {
            AsetBarangPakai::create($item);
        }
    }
}