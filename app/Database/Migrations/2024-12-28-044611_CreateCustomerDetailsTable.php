<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerDetailsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'         => ['type' => 'CHAR', 'constraint' => 12, 'null' => false],
            'full_name'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone_number'    => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true],
            'address'         => ['type' => 'TEXT', 'null' => true],
            'membership_level' => ['type' => 'ENUM', 'constraint' => ['bronze', 'silver', 'gold'], 'default' => 'bronze'],
            'total_spent'     => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
        ]);

        $this->forge->addPrimaryKey('id_user');
        $this->forge->addUniqueKey('phone_number'); // Tambahkan Unique Key
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('customer_details');
    }

    public function down()
    {
        $this->forge->dropTable('customer_details');
    }
}
