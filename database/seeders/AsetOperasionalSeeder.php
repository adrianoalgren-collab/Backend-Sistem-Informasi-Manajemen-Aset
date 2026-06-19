<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsetOperasionalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('aset_operasional')->insert([

            /*
            =====================================================
            ASET OPERASIONAL OFFICE (MASTER DATA)
            =====================================================
            */

            // Laptop Dell Latitude
            [
                'nama_asetoperasional' => 'Laptop Dell Latitude',
                'id_manufacturer' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Printer Epson L6490
            [
                'nama_asetoperasional' => 'Printer Epson L6490',
                'id_manufacturer' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // AC Split Daikin
            [
                'nama_asetoperasional' => 'AC Split Daikin',
                'id_manufacturer' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // CCTV Security Camera
            [
                'nama_asetoperasional' => 'CCTV Security Camera',
                'id_manufacturer' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            /*
            =====================================================
            ASET OPERASIONAL LAPANGAN (MASTER DATA)
            =====================================================
            */

            // Generator Cummins
            [
                'nama_asetoperasional' => 'Generator Cummins',
                'id_manufacturer' => 13,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Forklift Toyota
            [
                'nama_asetoperasional' => 'Forklift Toyota',
                'id_manufacturer' => 28,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Fire Extinguisher
            [
                'nama_asetoperasional' => 'Fire Extinguisher',
                'id_manufacturer' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Portable Gas Detector
            [
                'nama_asetoperasional' => 'Portable Gas Detector',
                'id_manufacturer' => 26,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}