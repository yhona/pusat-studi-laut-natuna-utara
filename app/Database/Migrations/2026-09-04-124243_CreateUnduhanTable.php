<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnduhanTable extends Migration
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
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'category_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'file_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'PDF',
            ],
            'file_size' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'year' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'downloads' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'desc' => [
                'type' => 'TEXT',
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
        $this->forge->createTable('unduhan', true);
    }

    public function down()
    {
        $this->forge->dropTable('unduhan', true);
    }
}
