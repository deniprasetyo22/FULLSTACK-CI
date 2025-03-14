<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'         => 1,
                'name' => 'administrator',
                'description' => 'Role Administrator'
            ],
            [
                'id'         => 2,
                'name' => 'product_manager',
                'description' => 'Role Product Manager'
            ],
            [
                'id'         => 3,
                'name' => 'customer',
                'description' => 'Role Customer'
            ]
        ];
        
        $this->db->table('auth_groups')->insertBatch($data);
    }
}