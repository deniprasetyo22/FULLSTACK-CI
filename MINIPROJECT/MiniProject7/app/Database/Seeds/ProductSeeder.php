<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Cheeseburger',
                'description' => 'Juicy grilled beef with cheese',
                'price'       => 50000,
                'stock'       => 20,
                'category_id' => 1,
                'status'      => 'Active',
                'is_new'      => true,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'French Fries',
                'description' => 'Crispy golden fries',
                'price'       => 30000,
                'stock'       => 25,
                'category_id' => 1,
                'status'      => 'Active',
                'is_new'      => false,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Grilled Chicken',
                'description' => 'Perfectly seasoned grilled chicken',
                'price'       => 70000,
                'stock'       => 15,
                'category_id' => 1,
                'status'      => 'Active',
                'is_new'      => true,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Pizza Margherita',
                'description' => 'Classic Italian pizza with fresh ingredients',
                'price'       => 85000,
                'stock'       => 10,
                'category_id' => 1,
                'status'      => 'Active',
                'is_new'      => false,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Spaghetti Carbonara',
                'description' => 'Creamy pasta with bacon and cheese',
                'price'       => 60000,
                'stock'       => 12,
                'category_id' => 1,
                'status'      => 'Active',
                'is_new'      => true,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Orange Juice',
                'description' => 'Freshly squeezed orange juice',
                'price'       => 25000,
                'stock'       => 0,
                'category_id' => 2,
                'status'      => 'Inactive',
                'is_new'      => false,
                'is_sale'     => false,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Iced Coffee',
                'description' => 'Cold brewed coffee with ice',
                'price'       => 35000,
                'stock'       => 20,
                'category_id' => 2,
                'status'      => 'Active',
                'is_new'      => true,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Lemon Tea',
                'description' => 'Refreshing lemon-flavored tea',
                'price'       => 20000,
                'stock'       => 40,
                'category_id' => 2,
                'status'      => 'Active',
                'is_new'      => false,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Milkshake',
                'description' => 'Creamy milkshake with vanilla flavor',
                'price'       => 30000,
                'stock'       => 5,
                'category_id' => 2,
                'status'      => 'Active',
                'is_new'      => true,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
            [
                'name'        => 'Mineral Water',
                'description' => 'Pure and refreshing mineral water',
                'price'       => 10000,
                'stock'       => 50,
                'category_id' => 2,
                'status'      => 'Active',
                'is_new'      => false,
                'is_sale'     => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}