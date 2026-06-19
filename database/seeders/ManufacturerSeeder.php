<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturerSeeder extends Seeder
{
    public function run(): void
    {
        /*
        =====================================================
        MANUFACTURER UNTUK STUDI KASUS PT ENERGI MEGA PERSADA
        Meliputi:
        - Kendaraan Operasional
        - Alat Berat
        - Generator & Compressor
        - Peralatan Kantor
        - Komputer & IT
        - Safety Equipment
        - Warehouse & Material Handling
        =====================================================
        */

        /*
        ================================
        KENDARAAN OPERASIONAL MIGAS
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT Toyota Astra Motor',
            'email_manufacturer' => 'customer@toyota.astra.co.id',
            'telfon_manufacturer' => '1500315'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Mitsubishi Motors Krama Yudha Sales Indonesia',
            'email_manufacturer' => 'cs@mitsubishi-motors.co.id',
            'telfon_manufacturer' => '08041300300'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Isuzu Astra Motor Indonesia',
            'email_manufacturer' => 'contact@isuzu-astra.com',
            'telfon_manufacturer' => '1500898'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Suzuki Indomobil Sales',
            'email_manufacturer' => 'customercare@suzuki.co.id',
            'telfon_manufacturer' => '08001100800'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Hino Motors Sales Indonesia',
            'email_manufacturer' => 'hmsi@hino.co.id',
            'telfon_manufacturer' => '08001800123'
        ]);


        /*
        ================================
        ALAT BERAT
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT United Tractors Tbk (Komatsu)',
            'email_manufacturer' => 'customercare@unitedtractors.com',
            'telfon_manufacturer' => '1500072'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Trakindo Utama (Caterpillar)',
            'email_manufacturer' => 'info@trakindo.co.id',
            'telfon_manufacturer' => '1500228'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Hexindo Adiperkasa Tbk (Hitachi)',
            'email_manufacturer' => 'marketing@hexindo-tbk.co.id',
            'telfon_manufacturer' => '021-4605959'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Kobexindo Tractors Tbk',
            'email_manufacturer' => 'info@kobexindo.com',
            'telfon_manufacturer' => '021-64701212'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Volvo Construction Equipment Indonesia',
            'email_manufacturer' => 'info@volvoce.co.id',
            'telfon_manufacturer' => '021-29976688'
        ]);


        /*
        ================================
        GENERATOR, COMPRESSOR, INDUSTRIAL
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT Atlas Copco Indonesia',
            'email_manufacturer' => 'customercenter.indonesia@atlascopco.com',
            'telfon_manufacturer' => '021-7801008'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Traktor Nusantara',
            'email_manufacturer' => 'info@traktor.co.id',
            'telfon_manufacturer' => '021-24579999'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Cummins Indonesia',
            'email_manufacturer' => 'info@cummins.co.id',
            'telfon_manufacturer' => '021-50999888'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Perkins Engines Indonesia',
            'email_manufacturer' => 'support@perkins.co.id',
            'telfon_manufacturer' => '021-88887777'
        ]);


        /*
        ================================
        KOMPUTER & IT EQUIPMENT
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT Dell Indonesia',
            'email_manufacturer' => 'support@dell.co.id',
            'telfon_manufacturer' => '001803441500'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Hewlett Packard Enterprise Indonesia',
            'email_manufacturer' => 'contact@hp.com',
            'telfon_manufacturer' => '021-57998888'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Lenovo Indonesia',
            'email_manufacturer' => 'service@lenovo.co.id',
            'telfon_manufacturer' => '0018030176120'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Asus Technology Indonesia',
            'email_manufacturer' => 'support@asus.co.id',
            'telfon_manufacturer' => '1500128'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Acer Indonesia',
            'email_manufacturer' => 'customercare@acer.co.id',
            'telfon_manufacturer' => '1500155'
        ]);


        /*
        ================================
        PRINTER, SCANNER, OFFICE EQUIPMENT
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT Epson Indonesia',
            'email_manufacturer' => 'customer.service@epson.co.id',
            'telfon_manufacturer' => '1500766'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Canon Business Solutions Indonesia',
            'email_manufacturer' => 'info@cbsi.canon.co.id',
            'telfon_manufacturer' => '021-29226000'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Brother International Sales Indonesia',
            'email_manufacturer' => 'support@brother.co.id',
            'telfon_manufacturer' => '021-29533999'
        ]);


        /*
        ================================
        FURNITURE KANTOR
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT Chitose Internasional Tbk',
            'email_manufacturer' => 'info@chitose.co.id',
            'telfon_manufacturer' => '022-7791222'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Fabelio Furnitur Indonesia',
            'email_manufacturer' => 'support@fabelio.com',
            'telfon_manufacturer' => '021-50999999'
        ]);


        /*
        ================================
        SAFETY EQUIPMENT (HSE)
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT 3M Indonesia',
            'email_manufacturer' => 'customer_service_id@mmm.com',
            'telfon_manufacturer' => '021-29974000'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Honeywell Indonesia',
            'email_manufacturer' => 'info@honeywell.co.id',
            'telfon_manufacturer' => '021-29810000'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Ansell Jaya Indonesia',
            'email_manufacturer' => 'sales@ansell.co.id',
            'telfon_manufacturer' => '021-88889999'
        ]);


        /*
        ================================
        WAREHOUSE & MATERIAL HANDLING
        ================================
        */

        Manufacturer::create([
            'nama_manufacturer' => 'PT Toyota Material Handling Indonesia',
            'email_manufacturer' => 'info@toyota-forklift.co.id',
            'telfon_manufacturer' => '021-8981234'
        ]);

        Manufacturer::create([
            'nama_manufacturer' => 'PT Jungheinrich Lift Truck Indonesia',
            'email_manufacturer' => 'sales@jungheinrich.co.id',
            'telfon_manufacturer' => '021-5556677'
        ]);
    }
}