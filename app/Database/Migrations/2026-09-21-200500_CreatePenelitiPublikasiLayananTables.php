<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenelitiPublikasiLayananTables extends Migration
{
    public function up()
    {
        // 1. Tabel Peneliti & Dewan Pakar
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'dewan_peneliti', // pimpinan, dewan_peneliti, eksternal
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'faculty' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'faculty_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'focus' => [
                'type' => 'TEXT',
            ],
            'focus_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'cluster' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'scopus' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'order_num' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
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
        $this->forge->createTable('peneliti', true);

        // 2. Tabel Publikasi & Policy Brief
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'number' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'policy_brief', // policy_brief, jurnal, monograf
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
            'year' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'author_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'desc' => [
                'type' => 'TEXT',
            ],
            'desc_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'downloads_count' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_published' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
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
        $this->forge->createTable('publikasi_brief', true);

        // 3. Tabel Layanan & Jasa Konsultasi
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
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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
            'desc' => [
                'type' => 'TEXT',
            ],
            'desc_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'standards' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sop_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'instruments' => [
                'type' => 'TEXT', // JSON encoded array
            ],
            'deliverables' => [
                'type' => 'TEXT', // JSON encoded array
            ],
            'order_num' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
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
        $this->forge->createTable('layanan_konsultasi', true);
    }

    public function down()
    {
        $this->forge->dropTable('peneliti', true);
        $this->forge->dropTable('publikasi_brief', true);
        $this->forge->dropTable('layanan_konsultasi', true);
    }
}
