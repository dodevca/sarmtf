<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitsTable extends Migration
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
            'price' => [
                'type' => 'INT',
                'constraint' => 15,
                'null' => false,
            ],
            'unitCode' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'date' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'dealer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('units');
    }

    public function down()
    {
        $this->forge->dropTable('units');
    }
}