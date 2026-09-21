<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroBannerModel extends Model
{
    protected $table            = 'hero_banners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'badge',
        'badge_en',
        'title',
        'title_en',
        'desc',
        'desc_en',
        'link_url',
        'tag',
        'tag_en',
        'image',
        'order_seq',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveBanners(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }
}
