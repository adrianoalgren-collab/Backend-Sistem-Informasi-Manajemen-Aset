<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AsetKendaraan;

class AsetKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aset_kendaraan')->insert([
            [
                'kode_kendaraan'    => 'KDR001',
                'nama_kendaraan'    => 'Mobil Operasional',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1234AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR002',
                'nama_kendaraan'    => 'Mobil Marketing',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1235AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR003',
                'nama_kendaraan'    => 'Motor Operasional',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1236AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR004',
                'nama_kendaraan'    => 'Mobil Direktur',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1237AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR005',
                'nama_kendaraan'    => 'Mobil Teknisi',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1238AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR006',
                'nama_kendaraan'    => 'Motor Lapangan',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1239AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_RUSAK_RINGAN, // ← 'Servis' diganti rusak_ringan
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR007',
                'nama_kendaraan'    => 'Mobil Survey',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1240AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR008',
                'nama_kendaraan'    => 'Motor Admin',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1241AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR009',
                'nama_kendaraan'    => 'Mobil Logistik',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1242AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_kendaraan'    => 'KDR010',
                'nama_kendaraan'    => 'Motor Kurir',
                'id_manufacturer'   => 1,
                'plat_kendaraan'    => 'BM1243AA',
                'kondisi_kendaraan' => AsetKendaraan::KONDISI_BAIK,
                'id_user'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}