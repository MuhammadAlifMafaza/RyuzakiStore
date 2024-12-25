<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Data yang akan dimasukkan ke dalam tabel users
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'customer1',
                'email'    => 'customer1@example.com',
                'password' => password_hash('customer123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'customer',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'customer2',
                'email'    => 'customer2@example.com',
                'password' => password_hash('customer123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'customer',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'admin2',
                'email'    => 'admin2@example.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT), // Hash password
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Menyimpan data ke dalam tabel users
        $this->db->table('users')->insertBatch($data);
    }
}