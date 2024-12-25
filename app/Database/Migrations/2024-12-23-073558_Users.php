<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false, // Kolom ini tidak boleh NULL
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false, // Kolom ini tidak boleh NULL
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false, // Kolom ini tidak boleh NULL
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'customer'], // Daftar role yang diizinkan
                'default' => 'customer', // Role default
                'null' => false, // Kolom ini tidak boleh NULL
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false, // Kolom ini tidak boleh NULL
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true, // Kolom ini boleh NULL
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}