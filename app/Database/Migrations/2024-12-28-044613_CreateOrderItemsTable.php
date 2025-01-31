<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order_item' => [
                'type' => 'CHAR',
                'constraint' => '12',
                'null' => false,
            ],
            'id_order' => [
                'type' => 'CHAR',
                'constraint' => '12',
            ],
            'id_product' => [
                'type' => 'CHAR',
                'constraint' => '12',
                'null' => false,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => false,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id_order_item');
        $this->forge->addForeignKey('id_order', 'orders', 'id_order', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_product', 'products', 'id_product', 'CASCADE', 'CASCADE');
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        $this->forge->dropTable('order_items');
    }
}
