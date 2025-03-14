<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'deni123',
                'email'      => 'deni@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Deni Prasetyo',
                'role'       => 'Admin',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'budi456',
                'email'      => 'budi@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Budi Santoso',
                'role'       => 'Customer',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'siti789',
                'email'      => 'siti@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Siti Aminah',
                'role'       => 'Customer',
                'status'     => 'Inactive',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'agus2024',
                'email'      => 'agus@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Agus Suryanto',
                'role'       => 'Admin',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'dewi88',
                'email'      => 'dewi@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Dewi Lestari',
                'role'       => 'Customer',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'eko1995',
                'email'      => 'eko@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Eko Prasetyo',
                'role'       => 'Customer',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'fitri123',
                'email'      => 'fitri@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Fitri Handayani',
                'role'       => 'Customer',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'gunawan99',
                'email'      => 'gunawan@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Gunawan Setiawan',
                'role'       => 'Admin',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'haniyah23',
                'email'      => 'haniyah@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Haniyah Susanti',
                'role'       => 'Customer',
                'status'     => 'Inactive',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'irfan78',
                'email'      => 'irfan@example.com',
                'password'   => password_hash('abc12345', PASSWORD_DEFAULT),
                'full_name'  => 'Irfan Maulana',
                'role'       => 'Customer',
                'status'     => 'Active',
                'last_login' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}