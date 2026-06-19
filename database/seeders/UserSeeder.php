<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        =====================================================
        USER ACCOUNT UNTUK STUDI KASUS PT ENERGI MEGA PERSADA
        1 akun untuk setiap department
        Role:
        1 = Admin
        2 = Manager
        3 = Staff
        =====================================================
        */

        /*
        ================================
        ADMIN UTAMA
        ================================
        */

        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@emp.co.id',
            'password' => Hash::make('admin123'),
            'id_role' => 1,
            'id_department' => 1,
        ]);


        /*
        ================================
        OPERATIONS
        ================================
        */

        User::create([
            'name' => 'Budi Operations',
            'email' => 'operations@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 1,
        ]);


        /*
        ================================
        DRILLING
        ================================
        */

        User::create([
            'name' => 'Andi Drilling',
            'email' => 'drilling@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 2,
        ]);


        /*
        ================================
        PRODUCTION
        ================================
        */

        User::create([
            'name' => 'Rizky Production',
            'email' => 'production@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 3,
        ]);


        /*
        ================================
        HSE
        ================================
        */

        User::create([
            'name' => 'Sinta HSE',
            'email' => 'hse@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 4,
        ]);


        /*
        ================================
        MAINTENANCE
        ================================
        */

        User::create([
            'name' => 'Doni Maintenance',
            'email' => 'maintenance@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 5,
        ]);


        /*
        ================================
        LOGISTICS
        ================================
        */

        User::create([
            'name' => 'Fajar Logistics',
            'email' => 'logistics@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 6,
        ]);


        /*
        ================================
        PROCUREMENT
        ================================
        */

        User::create([
            'name' => 'Putri Procurement',
            'email' => 'procurement@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 7,
        ]);


        /*
        ================================
        FINANCE
        ================================
        */

        User::create([
            'name' => 'Maya Finance',
            'email' => 'finance@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 8,
        ]);


        /*
        ================================
        ACCOUNTING
        ================================
        */

        User::create([
            'name' => 'Rina Accounting',
            'email' => 'accounting@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 9,
        ]);


        /*
        ================================
        HRD
        ================================
        */

        User::create([
            'name' => 'Nanda HRD',
            'email' => 'hrd@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 10,
        ]);


        /*
        ================================
        IT
        ================================
        */

        User::create([
            'name' => 'Joshua IT',
            'email' => 'it@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 11,
        ]);


        /*
        ================================
        LEGAL
        ================================
        */

        User::create([
            'name' => 'Sarah Legal',
            'email' => 'legal@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 12,
        ]);


        /*
        ================================
        CORPORATE COMMUNICATION
        ================================
        */

        User::create([
            'name' => 'Kevin Communication',
            'email' => 'corpcomm@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 13,
        ]);


        /*
        ================================
        ENGINEERING
        ================================
        */

        User::create([
            'name' => 'Teguh Engineering',
            'email' => 'engineering@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 14,
        ]);


        /*
        ================================
        SECURITY
        ================================
        */

        User::create([
            'name' => 'Agus Security',
            'email' => 'security@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 2,
            'id_department' => 15,
        ]);

        /*
        ================================
        DRIVER (ROLE ID = 5)
        Department ID = 16 (Driver)
        ================================
        */

        User::create([
            'name' => 'Joko Driver',
            'email' => 'driver1@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 5,
            'id_department' => 16,
        ]);

        User::create([
            'name' => 'Rudi Driver',
            'email' => 'driver2@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 5,
            'id_department' => 16,
        ]);

        User::create([
            'name' => 'Hendra Driver',
            'email' => 'driver3@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 5,
            'id_department' => 16,
        ]);

        User::create([
            'name' => 'Yanto Driver',
            'email' => 'driver4@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 5,
            'id_department' => 16,
        ]);

        User::create([
            'name' => 'Dedi Driver',
            'email' => 'driver5@emp.co.id',
            'password' => Hash::make('password123'),
            'id_role' => 5,
            'id_department' => 16,
        ]);
    }
}