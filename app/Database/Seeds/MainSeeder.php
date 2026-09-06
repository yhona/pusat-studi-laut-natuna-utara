<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->call('BeritaSeeder');
        $this->call('UnduhanSeeder');
        $this->call('RisetSeeder');
    }
}

