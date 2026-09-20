<?php

namespace App\Models;

use CodeIgniter\Model;

class UnduhanPermohonanModel extends Model
{
    protected $table            = 'unduhan_permohonan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'document_slug',
        'document_title',
        'recipient_email',
        'applicant_name',
        'applicant_email',
        'applicant_phone',
        'applicant_institution',
        'institution_category',
        'purpose',
        'ip_address',
        'email_status',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'document_slug'         => 'required|max_length[255]',
        'document_title'        => 'required|max_length[255]',
        'applicant_name'        => 'required|min_length[3]|max_length[255]',
        'applicant_email'       => 'required|valid_email|max_length[255]',
        'applicant_institution' => 'required|min_length[2]|max_length[255]',
        'purpose'               => 'required|min_length[5]',
    ];
}

