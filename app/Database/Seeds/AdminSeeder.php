<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_admin'     => 'ADM001',
                'username'     => 'adminuser',
                'password'     => password_hash('adminpass123', PASSWORD_DEFAULT),
                'full_name'    => 'Admin User',
                'email'        => 'admin@example.com',
                'phone_number' => '081234567890',
                'address'      => 'Admin Address',
                'department'   => 'Administration',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ]
        ];

        // Using Query Builder to insert data
        $this->db->table('admin')->insertBatch($data);
    }
}
