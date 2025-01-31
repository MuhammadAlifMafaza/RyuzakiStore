<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin'     => ['type' => 'VARCHAR', 'constraint' => 12, 'null' => false],
            'username'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'password'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'full_name'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true, 'unique' => true,],
            'address'      => ['type' => 'TEXT', 'null' => true],
            'department'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id_admin');
        $this->forge->createTable('admin');
    }


    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
