<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthPermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'manage-users',
                'description' => 'Manage All Users'
            ],
            [
                'id' => 2,
                'name' => 'manage-profile',
                'description' => "Manage User's Profile"
            ]
        ];

        $this->db->table('auth_permissions')->insertBatch($data);
    }
}