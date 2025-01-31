<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_customer'      => 'CUST001',
                'username'         => 'customer1',
                'password'         => password_hash('customerpass1', PASSWORD_DEFAULT),
                'email'            => 'customer1@example.com',
                'full_name'        => 'Customer One',
                'phone_number'     => '082345678901',
                'address'          => 'Customer Address 1',
                'membership_level' => 'bronze',
                'total_spent'      => 0.00,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s')
            ]
        ];

        // Using Query Builder to insert data
        $this->db->table('customer')->insertBatch($data);
    }
}
