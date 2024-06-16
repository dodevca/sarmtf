<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DealersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('dealers');
    }

    public function down()
    {
        $this->forge->dropTable('dealers');
    }
}