<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKlasterRisetTable extends Migration
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
                'constraint' => 100,
                'unique'     => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'title_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'short_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'badge' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'mandate' => [
                'type' => 'TEXT',
            ],
            'coordinator' => [
                'type' => 'TEXT',
            ],
            'focus_areas' => [
                'type' => 'TEXT',
            ],
            'flagship_projects' => [
                'type' => 'TEXT',
            ],
            'facilities' => [
                'type' => 'TEXT',
            ],
            'publications' => [
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
        $this->forge->createTable('klaster_riset', true);
    }

    public function down()
    {
        $this->forge->dropTable('klaster_riset', true);
    }
}
