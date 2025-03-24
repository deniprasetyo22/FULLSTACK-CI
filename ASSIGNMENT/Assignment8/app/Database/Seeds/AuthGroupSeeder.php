<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'admin',
                'description' => 'Role Admin'
            ],
            [
                'id' => 2,
                'name' => 'student',
                'description' => 'Role Student'
            ],
            [
                'id' => 3,
                'name' => 'lecturer',
                'description' => 'Role Lecturer'
            ],
        ];

        $this->db->table('auth_groups')->insertBatch($data);
    }
}