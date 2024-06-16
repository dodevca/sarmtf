<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubmissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'uid' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'phoneNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
            'address' => [
                'type' => 'MEDIUMTEXT',
                'null' => false,
            ],
            'identity' => [
                'type' => 'LONGTEXT',
                'null' => false,
                'collate' => 'utf8mb4_bin',
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'price' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => false,
            ],
            'tenor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'package' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'insurance' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => false,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'surveyor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'sales' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'dateSubmitted' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'current_timestamp()',
                'on_update' => 'current_timestamp()',
            ],
            'dealer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('submissions');
    }

    public function down()
    {
        $this->forge->dropTable('submissions');
    }
}