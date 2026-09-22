<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsUsersLogsTables extends Migration
{
    public function up()
    {
        // 1. Ensure `is_active` column in `admin_users`
        if (! $this->db->fieldExists('is_active', 'admin_users')) {
            $this->forge->addColumn('admin_users', [
                'is_active' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'default'    => 1,
                ],
            ]);
        }

        // 2. Create `site_settings` table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'address_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'hours_weekday' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'hours_friday' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'hours_weekend' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'youtube_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'instagram_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'twitter_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'linkedin_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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
        $this->forge->createTable('site_settings', true);

        // 3. Create `admin_activity_logs` table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'admin_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'admin_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'action' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'null'       => true,
            ],
            'user_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('created_at');
        $this->forge->addKey('action');
        $this->forge->createTable('admin_activity_logs', true);

        // Seed initial site_settings if table is empty
        $db = \Config\Database::connect();
        $builder = $db->table('site_settings');
        if ($builder->countAllResults() === 0) {
            $now = date('Y-m-d H:i:s');
            $builder->insert([
                'id'            => 1,
                'address'       => 'Gedung LPPM UMRAH Lantai 2, Kampus Terpadu Dompak, Jl. Politeknik, Kota Tanjungpinang, Kepulauan Riau 29111',
                'address_en'    => 'LPPM UMRAH Building, 2nd Floor, Dompak Main Campus, Jl. Politeknik, Tanjungpinang City, Riau Islands 29111, Indonesia',
                'email'         => 'pusatstudilautnatunautara@umrah.ac.id',
                'phone'         => '(0771) 4500089 / 4500090',
                'hours_weekday' => '08.00 – 16.00 WIB',
                'hours_friday'  => '08.00 – 16.30 WIB',
                'hours_weekend' => 'Tutup / Closed',
                'youtube_url'   => 'https://youtube.com/@umrah',
                'instagram_url' => 'https://instagram.com/umrah.ac.id',
                'twitter_url'   => 'https://x.com/umrah_official',
                'linkedin_url'  => 'https://linkedin.com/school/umrah',
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('admin_activity_logs', true);
        $this->forge->dropTable('site_settings', true);

        if ($this->db->fieldExists('is_active', 'admin_users')) {
            $this->forge->dropColumn('admin_users', 'is_active');
        }
    }
}
