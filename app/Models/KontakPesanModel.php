<?php

namespace App\Models;

use CodeIgniter\Model;

class KontakPesanModel extends Model
{
    protected $table            = 'kontak_pesan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'instansi',
        'email',
        'telepon',
        'kategori',
        'pesan',
        'status',
        'ip_address',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules for safety
    protected $validationRules = [
        'nama'     => 'required|min_length[3]|max_length[150]',
        'email'    => 'required|valid_email|max_length[150]',
        'pesan'    => 'required|min_length[10]',
        'kategori' => 'permit_empty|max_length[100]',
        'instansi' => 'permit_empty|max_length[200]',
        'telepon'  => 'permit_empty|max_length[50]',
    ];
}

