<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananKonsultasiModel extends Model
{
    protected $table            = 'layanan_konsultasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'slug',
        'icon',
        'title',
        'title_en',
        'desc',
        'desc_en',
        'code',
        'standards',
        'sop_name',
        'instruments',
        'deliverables',
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

    protected $afterFind = ['decodeJsonFields'];

    protected function decodeJsonFields(array $data)
    {
        if (! isset($data['data'])) {
            return $data;
        }

        if (isset($data['data']['instruments']) && is_string($data['data']['instruments'])) {
            $data['data']['instruments'] = json_decode($data['data']['instruments'], true) ?? [];
        }
        if (isset($data['data']['deliverables']) && is_string($data['data']['deliverables'])) {
            $data['data']['deliverables'] = json_decode($data['data']['deliverables'], true) ?? [];
        }

        if (is_array($data['data']) && ! isset($data['data']['id'])) {
            foreach ($data['data'] as &$row) {
                if (isset($row['instruments']) && is_string($row['instruments'])) {
                    $row['instruments'] = json_decode($row['instruments'], true) ?? [];
                }
                if (isset($row['deliverables']) && is_string($row['deliverables'])) {
                    $row['deliverables'] = json_decode($row['deliverables'], true) ?? [];
                }
            }
        }

        return $data;
    }
}
