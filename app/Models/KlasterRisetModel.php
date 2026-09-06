<?php

namespace App\Models;

use CodeIgniter\Model;

class KlasterRisetModel extends Model
{
    protected $table            = 'klaster_riset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'slug',
        'title',
        'title_en',
        'short_title',
        'icon',
        'badge',
        'mandate',
        'coordinator',
        'focus_areas',
        'flagship_projects',
        'facilities',
        'publications',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $afterFind = ['decodeJsonFields'];

    /**
     * Decode JSON fields into associative arrays for view compatibility.
     */
    protected function decodeJsonFields(array $data): array
    {
        if (empty($data['data'])) {
            return $data;
        }

        if ($data['singleton']) {
            $data['data'] = $this->transformRow($data['data']);
            return $data;
        }

        foreach ($data['data'] as &$row) {
            $row = $this->transformRow($row);
        }

        return $data;
    }

    private function transformRow(array $row): array
    {
        // Maintain compatibility with views expecting $cluster['id']
        if (!isset($row['id_slug']) && isset($row['slug'])) {
            $row['id'] = $row['slug'];
        }

        $jsonFields = ['coordinator', 'focus_areas', 'flagship_projects', 'facilities', 'publications'];
        foreach ($jsonFields as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $decoded = json_decode($row[$field], true);
                $row[$field] = is_array($decoded) ? $decoded : [];
            }
        }

        return $row;
    }
}

