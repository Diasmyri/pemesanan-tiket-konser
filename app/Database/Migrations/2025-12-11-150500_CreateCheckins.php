<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCheckins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'order_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'checked_in_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'checked_in'],
                'default'    => 'pending'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('checkins');
    }

    public function down()
    {
        $this->forge->dropTable('checkins');
    }
}
