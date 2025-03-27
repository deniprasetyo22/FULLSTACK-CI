<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'product_id' => 1,
                'image_path' => 'images/products/cheeseburger.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 2,
                'image_path' => 'images/products/french_fries.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 3,
                'image_path' => 'images/products/grilled_chicken.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 4,
                'image_path' => 'images/products/pizza_margherita.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 5,
                'image_path' => 'images/products/spaghetti_carbonara.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 6,
                'image_path' => 'images/products/orange_juice.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 7,
                'image_path' => 'images/products/iced_coffee.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 8,
                'image_path' => 'images/products/lemon_tea.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 9,
                'image_path' => 'images/products/milkshake.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_id' => 10,
                'image_path' => 'images/products/mineral_water.jpg',
                'is_primary' => true,
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('product_images')->insertBatch($data);
    }
}