<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeritaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'excerpt' => [
                'type' => 'TEXT',
            ],
            'content' => [
                'type' => 'TEXT', // JSON array of paragraphs
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tag' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'tags' => [
                'type' => 'TEXT', // JSON array of tags
                'null' => true,
            ],
            'key_takeaways' => [
                'type' => 'TEXT', // JSON array of takeaway points
                'null' => true,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'author_role' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'read_time' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'image_caption' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'date_formatted' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'is_featured' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'published_at' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('berita', true);
    }

    public function down()
    {
        $this->forge->dropTable('berita', true);
    }
}
