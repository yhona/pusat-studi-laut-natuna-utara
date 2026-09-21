<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriRisetModel extends Model
{
    protected $table            = 'galeri_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'title_en',
        'category',
        'image',
        'date_text',
        'date_text_en',
        'location',
        'location_en',
        'vessel',
        'vessel_en',
        'focal',
        'focal_en',
        'desc',
        'desc_en',
        'order_seq',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveGallery(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
