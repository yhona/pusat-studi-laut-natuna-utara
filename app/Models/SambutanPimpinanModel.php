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
        'role_key',
        'order_seq',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active leader greeting by role key.
     */
    public function getByRole(string $role): ?array
    {
        return $this->where('role_key', $role)
            ->where('is_active', 1)
            ->first();
    }

    /**
     * Get all active greetings ordered by sequence.
     */
    public function getAllActive(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    /**
     * Get active leader greeting.
     */
    public function getLeader(): ?array
    {
        return $this->where('is_active', 1)
            ->orderBy('order_seq', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();
    }
}
