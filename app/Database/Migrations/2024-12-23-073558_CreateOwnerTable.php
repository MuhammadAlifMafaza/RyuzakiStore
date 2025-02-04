<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOwnerTable extends Migration
{
    public function up()
    {
        // Membuat tabel owner_details
        $this->forge->addField([
            'id_owner'      => ['type' => 'VARCHAR', 'constraint' => '12', 'null' => false,],
            'username'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'password'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'full_name'     => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true,],
            'img_profile'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'email'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'phone_number'  => ['type' => 'VARCHAR', 'constraint' => '15', 'null' => true, 'unique' => true,],
            'store_name'    => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true,],
            'store_address' => ['type' => 'TEXT', 'null' => true,],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id_owner', true);
        $this->forge->createTable('owner');
    }

    public function down()
    {
        $this->forge->dropTable('owner');
    }
}
