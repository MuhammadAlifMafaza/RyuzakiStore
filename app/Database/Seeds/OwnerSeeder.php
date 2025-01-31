<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class OwnerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_owner'       => 'OWN001',
                'username'       => 'Ryuzaki',
                'password'       => password_hash('ryuzaki123', PASSWORD_DEFAULT),
                'full_name'      => 'Zhuxyd Ryuzaki',
                'email'          => 'ZhuxyRyuzaki@store.id',
                'phone_number'   => '083456789012',
                'store_name'     => 'Ryuzaki Store',
                'store_address'  => 'Store Address 123',
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s')
            ],
        ];

        // Using Query Builder to insert data
        $this->db->table('owner')->insertBatch($data);
    }
}
