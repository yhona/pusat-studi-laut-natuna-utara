<?php

namespace App\Models;

use CodeIgniter\Model;

class PublikasiBriefModel extends Model
{
    protected $table            = 'publikasi_brief';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'number',
        'type',
        'title',
        'title_en',
        'year',
        'author',
        'author_en',
        'desc',
        'desc_en',
        'file_path',
        'downloads_count',
        'is_published',
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
        'number' => 'required|min_length[3]|max_length[100]',
        'title'  => 'required|min_length[5]|max_length[255]',
        'year'   => 'required|exact_length[4]|numeric',
        'author' => 'required|min_length[3]|max_length[255]',
        'desc'   => 'required',
    ];
}
