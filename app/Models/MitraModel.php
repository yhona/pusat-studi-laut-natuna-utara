<?php

namespace App\Models;

use CodeIgniter\Model;

class MitraModel extends Model
{
    protected $table            = 'mitra_kerjasama';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'short_name',
        'category',
        'logo',
        'website_url',
        'order_seq',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActivePartners(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
