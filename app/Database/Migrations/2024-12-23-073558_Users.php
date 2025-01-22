<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'    => ['type' => 'CHAR', 'constraint' => 12, 'null' => false],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'role'       => ['type' => 'ENUM', 'constraint' => ['admin', 'customer', 'owner'], 'null' => false],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id_user');
        $this->forge->addUniqueKey(['username', 'email']); // Tambahkan Unique Key
        $this->forge->createTable('users');
    }
}
