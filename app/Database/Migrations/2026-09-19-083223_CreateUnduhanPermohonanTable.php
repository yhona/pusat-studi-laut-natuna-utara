<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnduhanPermohonanTable extends Migration
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
            'document_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'document_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'recipient_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'applicant_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'applicant_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'applicant_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'applicant_institution' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'institution_category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'purpose' => [
                'type' => 'TEXT',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'email_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'pending',
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
        $this->forge->addKey('document_slug');
        $this->forge->addKey('created_at');
        $this->forge->createTable('unduhan_permohonan', true);
    }

    public function down()
    {
        $this->forge->dropTable('unduhan_permohonan', true);
    }
}
