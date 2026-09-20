<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'      => 'admin_nnsrc',
            'email'         => 'pusatstudi.natuna@umrah.ac.id',
            'password_hash' => password_hash('AdminNatuna2026!', PASSWORD_BCRYPT),
            'name'          => 'Administrator NNSRC UMRAH',
            'role'          => 'superadmin',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Check if user already exists
        $builder = $this->db->table('admin_users');
        $existing = $builder->where('username', $data['username'])->get()->getRow();

        if (! $existing) {
            $builder->insert($data);
        }
    }
}
