<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_customer'      => ['type' => 'VARCHAR', 'constraint' => 12, 'null' => false],
            'username'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'password'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'full_name'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'img_profile'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'email'            => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true, 'unique' => true,],
            'address'          => ['type' => 'TEXT', 'null' => true],
            'membership_level' => ['type' => 'ENUM', 'constraint' => ['bronze', 'silver', 'gold'], 'default' => 'bronze'],
            'total_spent'      => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id_customer');
        $this->forge->createTable('customer');
    }

    public function down()
    {
        $this->forge->dropTable('customer');
    }
}
