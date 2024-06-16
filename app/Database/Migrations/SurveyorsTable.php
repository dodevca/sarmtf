<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SurveyorsTable extends Migration
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
            'uid' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('surveyors');
    }

    public function down()
    {
        $this->forge->dropTable('surveyors');
    }
}