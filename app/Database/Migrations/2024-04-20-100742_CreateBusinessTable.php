<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusinessTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'business_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'name' => [
                'type' => 'INT',
                'constraint' => '255',
            ],
            'table' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addKey('business_id', TRUE);
        $this->forge->addForeignKey('user_id', 'User', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Business');
    }

    public function down()
    {
        $this->forge->dropTable('Business');
    }
}