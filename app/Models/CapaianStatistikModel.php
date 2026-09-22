<?php

namespace App\Models;

use CodeIgniter\Model;

class CapaianStatistikModel extends Model
{
    protected $table            = 'capaian_statistik';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'number',
        'label',
        'label_en',
        'icon',
        'order_seq',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active statistics ordered by order_seq ASC, id ASC.
     */
    public function getActiveStats(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
