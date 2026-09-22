<?php

namespace App\Models;

use CodeIgniter\Model;

class RoadmapRisetModel extends Model
{
    protected $table            = 'roadmap_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'phase',
        'title',
        'title_en',
        'desc',
        'desc_en',
        'status',
        'status_en',
        'order_seq',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active roadmap phases ordered by order_seq ASC, id ASC.
     */
    public function getActiveRoadmap(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
