<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'id_role' => 1,
                'nama_role' => 'Admin'
            ],
            [
                'id_role' => 2,
                'nama_role' => 'Manager'
            ],
            [
                'id_role' => 3,
                'nama_role' => 'Staff Kantor'
            ],
            [
                'id_role' => 4,
                'nama_role' => 'Staff Lapangan'
            ],
            [
                'id_role' => 5,
                'nama_role' => 'Driver'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}