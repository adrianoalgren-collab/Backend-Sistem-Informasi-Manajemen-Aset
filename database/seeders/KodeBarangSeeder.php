<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodeBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kode_barang')->insert([

            /*
            =====================================================
            LAPTOP DELL LATITUDE
            id_operasional = 1
            =====================================================
            */

            [
                'kode_barang' => 'OFF001',
                'id_operasional' => 1,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'IT Department',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'OFF002',
                'id_operasional' => 1,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Engineering Department',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'OFF003',
                'id_operasional' => 1,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Finance Department',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            PRINTER EPSON L6490
            id_operasional = 2
            =====================================================
            */

            [
                'kode_barang' => 'OFF004',
                'id_operasional' => 2,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Administration Office',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'OFF005',
                'id_operasional' => 2,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'HR Department',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            AC SPLIT DAIKIN
            id_operasional = 3
            =====================================================
            */

            [
                'kode_barang' => 'OFF006',
                'id_operasional' => 3,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Director Room',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'OFF007',
                'id_operasional' => 3,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Main Meeting Room',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            CCTV SECURITY CAMERA
            id_operasional = 4
            =====================================================
            */

            [
                'kode_barang' => 'OFF008',
                'id_operasional' => 4,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Main Lobby',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'OFF009',
                'id_operasional' => 4,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Parking Area',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            GENERATOR CUMMINS
            id_operasional = 5
            =====================================================
            */

            [
                'kode_barang' => 'LAP001',
                'id_operasional' => 5,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Production Site A',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'LAP002',
                'id_operasional' => 5,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Production Site B',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            FORKLIFT TOYOTA
            id_operasional = 6
            =====================================================
            */

            [
                'kode_barang' => 'LAP003',
                'id_operasional' => 6,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Warehouse Area',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'LAP004',
                'id_operasional' => 6,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Warehouse Area 2',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            FIRE EXTINGUISHER
            id_operasional = 7
            =====================================================
            */

            [
                'kode_barang' => 'LAP005',
                'id_operasional' => 7,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Production Field',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'LAP006',
                'id_operasional' => 7,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Drilling Area',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            =====================================================
            PORTABLE GAS DETECTOR
            id_operasional = 8
            =====================================================
            */

            [
                'kode_barang' => 'LAP007',
                'id_operasional' => 8,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Production Area',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_barang' => 'LAP008',
                'id_operasional' => 8,
                'kondisi_asetoperasional' => 'Baik',
                'lokasi_asetoperasional' => 'Drilling Site',
                'foto_asetoperasional' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}