<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order' => ['type' => 'CHAR', 'constraint' => '12',],
            'id_customer'      => ['type' => 'VARCHAR', 'constraint' => 12, 'null' => false],
            'order_date' => ['type' => 'TEXT', 'null' => true,],
            'destination_address' => ['type' => 'DATETIME', 'null' => false,],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'shipped', 'completed', 'canceled'],
                'default' => 'pending',
            ],
            'total_amount' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true,],
        ]);
        $this->forge->addPrimaryKey('id_order');
        $this->forge->addForeignKey('id_customer', 'customer', 'id_customer', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
