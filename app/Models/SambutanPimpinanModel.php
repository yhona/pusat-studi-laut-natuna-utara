<?php

namespace App\Models;

use CodeIgniter\Model;

class SambutanPimpinanModel extends Model
{
    protected $table            = 'sambutan_pimpinan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'title',
        'title_en',
        'heading',
        'heading_en',
        'quote',
        'quote_en',
        'content',
        'content_en',
        'image',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active leader greeting.
     */
    public function getLeader(): ?array
    {
        return $this->where('is_active', 1)
            ->orderBy('id', 'ASC')
            ->first();
    }
}
