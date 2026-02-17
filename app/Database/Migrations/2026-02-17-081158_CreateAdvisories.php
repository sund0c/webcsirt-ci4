<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdvisories extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'unique' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'excerpt' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'body' => [
                'type' => 'LONGTEXT',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['PUBLISHED', 'DRAFT'],
                'default' => 'DRAFT',
            ],
            'source_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'featured_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'file_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
                'null' => true,
            ],
            'image_caption' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'published_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_by' => [
                'type' => 'BIGINT',
                'unsigned' => true,
            ],
            'updated_by' => [
                'type' => 'BIGINT',
                'unsigned' => true,
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at DATETIME NULL',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('created_by', 'users', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->addForeignKey('updated_by', 'users', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('advisories');
    }


    public function down()
    {
        $this->forge->dropTable('advisories', true);
    }
}
