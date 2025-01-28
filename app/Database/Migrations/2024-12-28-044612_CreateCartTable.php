<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cart' => [
                'type' => 'CHAR',
                'constraint' => '12',
            ],
            'id_user'    => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
                'auto_increment' => true,
            ],
            'id_product' => [
                'type' => 'CHAR',
                'constraint' => '12',
                'null' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_cart');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_product', 'products', 'id_product', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cart');
    }

    public function down()
    {
        $this->forge->dropTable('cart');
    }
}
