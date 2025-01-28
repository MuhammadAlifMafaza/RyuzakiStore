<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOwnerDetailsTable extends Migration
{
    public function up()
    {
        // Membuat tabel owner_details
        $this->forge->addField([
            'id_user' => [
                'type' => 'CHAR',
                'constraint' => '12',
                'null' => false,
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => true,
                'unique' => true, // Menjamin nomor telepon unik
            ],
            'store_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'store_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('owner_details');
    }

    public function down()
    {
        $this->forge->dropTable('owner_details');
    }
}