<?php

namespace App\Models;

use CodeIgniter\Model;

class PenelitiModel extends Model
{
    protected $table            = 'peneliti';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category',
        'name',
        'role',
        'role_en',
        'faculty',
        'faculty_en',
        'focus',
        'focus_en',
        'cluster',
        'nip',
        'scopus',
        'email',
        'image',
        'order_num',
        'is_active',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'name'     => 'required|min_length[3]|max_length[255]',
        'role'     => 'required|min_length[3]|max_length[255]',
        'email'    => 'required|valid_email|max_length[150]',
        'category' => 'required|in_list[pimpinan,dewan_peneliti,eksternal]',
    ];

    /**
     * Get researchers filtered by category.
     */
    public function getByCategory(string $category): array
    {
        return $this->where('category', $category)
                    ->where('is_active', 1)
                    ->orderBy('order_num', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }
}
