<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'site_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],

            'site_tagline' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'site_email' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true,
            ],

            'site_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],

            'site_address' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            'kanal_aduan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'favicon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('site_settings');
    }

    public function down()
    {
        $this->forge->dropTable('site_settings');
    }
}
