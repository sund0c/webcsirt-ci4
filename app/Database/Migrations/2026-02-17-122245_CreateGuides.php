<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuides extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type'           => 'BIGINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],

            // Nama asli file (untuk display)
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            // Nama file di server (random)
            'stored_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],

            // SHA256
            'file_hash' => [
                'type'       => 'CHAR',
                'constraint' => 64,
            ],

            'file_size' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],

            'file_mime' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],

            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['PUBLISHED', 'DRAFT'],
                'default'    => 'DRAFT',
            ],
            'published_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
            ],

            'updated_by' => [
                'type'     => 'BIGINT',
                'unsigned' => true,
                'null'     => true,
            ],

            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('created_by', 'users', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('updated_by', 'users', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('guides');
    }

    public function down()
    {
        $this->forge->dropTable('guides');
    }
}
