<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIncidentReports extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'reporter_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'reporter_email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'organization' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],
            'incident_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'LONGTEXT',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['NEW', 'PROCESS', 'CLOSED'],
                'default' => 'NEW',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('incident_reports');
    }

    public function down()
    {
        $this->forge->dropTable('incident_reports');
    }
}
