<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 1,
                'null' => false,
            ],
            'whatsAppNumber' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
            ],
            'pricelist' => [
                'type' => 'LONGTEXT',
                'null' => true,
                'collate' => 'utf8mb4_bin',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}