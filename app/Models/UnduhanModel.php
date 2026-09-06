<?php

namespace App\Models;

use CodeIgniter\Model;

class UnduhanModel extends Model
{
    protected $table            = 'unduhan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'code',
        'slug',
        'title',
        'category',
        'category_id',
        'file_type',
        'file_size',
        'year',
        'downloads',
        'desc',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Increment download counter by slug or code.
     */
    public function incrementDownload(string $slug): bool
    {
        $builder = $this->builder();
        $builder->groupStart()
            ->where('slug', $slug)
            ->orWhere('code', $slug)
            ->groupEnd();

        return (bool) $builder->increment('downloads', 1);
    }
}

