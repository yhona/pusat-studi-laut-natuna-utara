<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleKeyToSambutanTable extends Migration
{
    public function up()
    {
        $fields = [
            'role_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'koordinator',
            ],
            'order_seq' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
        ];

        $this->forge->addColumn('sambutan_pimpinan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('sambutan_pimpinan', ['role_key', 'order_seq']);
    }
}
