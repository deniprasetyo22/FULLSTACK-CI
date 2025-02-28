<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Food', 
                'description' => 'Various delicious foods', 
                'status' => 'active', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Beverage', 
                'description' => 'Refreshing drinks', 
                'status' => 'active', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}