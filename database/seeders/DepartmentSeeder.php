<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('department')->insert([

            /*
            =====================================================
            DEPARTMENT
            PT ENERGI MEGA PERSADA
            =====================================================
            */

            [
                'kode_department' => 'OPS01',
                'nama_department' => 'Operations',
                'penanggungjawab_department' => 'Operations Manager',
                'email_department' => 'operations@emp.co.id',
                'nomor_telepon_department' => '021500101',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'DRL01',
                'nama_department' => 'Drilling',
                'penanggungjawab_department' => 'Drilling Manager',
                'email_department' => 'drilling@emp.co.id',
                'nomor_telepon_department' => '021500102',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'PRD01',
                'nama_department' => 'Production',
                'penanggungjawab_department' => 'Production Manager',
                'email_department' => 'production@emp.co.id',
                'nomor_telepon_department' => '021500103',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'HSE01',
                'nama_department' => 'Health Safety Environment',
                'penanggungjawab_department' => 'HSE Manager',
                'email_department' => 'hse@emp.co.id',
                'nomor_telepon_department' => '021500104',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'MNT01',
                'nama_department' => 'Maintenance',
                'penanggungjawab_department' => 'Maintenance Manager',
                'email_department' => 'maintenance@emp.co.id',
                'nomor_telepon_department' => '021500105',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'LOG01',
                'nama_department' => 'Logistics',
                'penanggungjawab_department' => 'Logistics Manager',
                'email_department' => 'logistics@emp.co.id',
                'nomor_telepon_department' => '021500106',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'PRC01',
                'nama_department' => 'Procurement',
                'penanggungjawab_department' => 'Procurement Manager',
                'email_department' => 'procurement@emp.co.id',
                'nomor_telepon_department' => '021500107',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'FIN01',
                'nama_department' => 'Finance',
                'penanggungjawab_department' => 'Finance Manager',
                'email_department' => 'finance@emp.co.id',
                'nomor_telepon_department' => '021500108',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'ACC01',
                'nama_department' => 'Accounting',
                'penanggungjawab_department' => 'Accounting Manager',
                'email_department' => 'accounting@emp.co.id',
                'nomor_telepon_department' => '021500109',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'HRD01',
                'nama_department' => 'Human Resource Development',
                'penanggungjawab_department' => 'HR Manager',
                'email_department' => 'hrd@emp.co.id',
                'nomor_telepon_department' => '021500110',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'IT01',
                'nama_department' => 'Information Technology',
                'penanggungjawab_department' => 'IT Manager',
                'email_department' => 'it@emp.co.id',
                'nomor_telepon_department' => '021500111',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'LEG01',
                'nama_department' => 'Legal',
                'penanggungjawab_department' => 'Legal Manager',
                'email_department' => 'legal@emp.co.id',
                'nomor_telepon_department' => '021500112',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'COM01',
                'nama_department' => 'Corporate Communication',
                'penanggungjawab_department' => 'Communication Manager',
                'email_department' => 'corpcomm@emp.co.id',
                'nomor_telepon_department' => '021500113',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'ENG01',
                'nama_department' => 'Engineering',
                'penanggungjawab_department' => 'Engineering Manager',
                'email_department' => 'engineering@emp.co.id',
                'nomor_telepon_department' => '021500114',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'SEC01',
                'nama_department' => 'Security',
                'penanggungjawab_department' => 'Security Manager',
                'email_department' => 'security@emp.co.id',
                'nomor_telepon_department' => '021500115',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode_department' => 'DRV01',
                'nama_department' => 'Driver',
                'penanggungjawab_department' => 'Driver Supervisor',
                'email_department' => 'driver@emp.co.id',
                'nomor_telepon_department' => '021500116',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}