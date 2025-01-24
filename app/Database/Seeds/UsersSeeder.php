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
                'id_user' => 'ADMN-001',
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'admin123',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => 'ADMN-002',
                'username' => 'admin2',
                'email'    => 'admin2@example.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT), // Hash password
                'role'     => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => 'CSTMR-001',
                'username' => 'customer1',
                'email'    => 'customer1@example.com',
                'password' => password_hash('customer123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'customer',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => 'CSTMR-002',
                'username' => 'customer2',
                'email'    => 'customer2@example.com',
                'password' => password_hash('customer123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'customer',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_user' => 'OWNR-001',
                'username' => 'owner',
                'email'    => 'ownerRyuzakiStore@example.com',
                'password' => password_hash('owner123', PASSWORD_DEFAULT), // Hash password
                'role'     => 'owner',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Menyimpan data ke dalam tabel users
        $this->db->table('users')->insertBatch($data);
    }
}