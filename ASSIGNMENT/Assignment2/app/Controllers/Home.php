<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // return view('welcome_message');
        return '<div>
        <h1>Welcome to the Article Management System.</h1>
        <a href="/articles">Article</a>
        </div>';
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }


    /* Parser */
    public function product()
    {
        $parser = \Config\Services::parser();
        $data = [
            'page_title' => 'Daftar Produk',
            'products' => [
                ['name' => 'Laptop', 'price' => 8000000, 'stock' => 5],
                ['name' => 'Smartphone', 'price' => 3000000, 'stock' => 10],
                ['name' => 'Tablet', 'price' => 4000000, 'stock' => 3]
            ],
            'company_name' => 'Toko Elektronik',
            'is_sale' => true
        ];
        
        return $parser->setData($data)->render('pages/products');
    }

    public function profile()
    {
        $parser = \Config\Services::parser();
        
        $data = [
            'user' => [
                'name' => 'John Doe',
                'age' => 25,
                'role' => 'admin',
                'is_verified' => true,
                'subscription' => 'premium',
                'login_count' => 50,
                'points' => 750,
                'last_login' => '2025-02-15',
                'notifications' => [
                    ['type' => 'message', 'count' => 3],
                    ['type' => 'alert', 'count' => 1]
                ]
            ],
            'site_settings' => [
                'maintenance_mode' => false,
                'allow_registration' => true
            ]
        ];
        
        return $parser->setData($data)->render('pages/profile');
    }

    public function latihanParser1()
    {
        $parser = \Config\Services::parser();

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'address' => 'Example Street No.1',
            'join_date' => '01-01-2025'
        ];

        return $parser->setData($data)->render('pages/latihanparser1');
    }
}