<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'slug',
        'title',
        'excerpt',
        'content',
        'category',
        'tag',
        'tags',
        'key_takeaways',
        'author',
        'author_role',
        'read_time',
        'image',
        'image_caption',
        'date_formatted',
        'is_featured',
        'published_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $afterFind = ['decodeJsonFields'];

    /**
     * Automatically decode JSON fields into PHP arrays for clean view rendering.
     */
    protected function decodeJsonFields(array $data): array
    {
        if (empty($data['data'])) {
            return $data;
        }

        // Single record (find / first)
        if ($data['singleton']) {
            $data['data'] = $this->transformRow($data['data']);
            return $data;
        }

        // Multiple records (findAll)
        foreach ($data['data'] as &$row) {
            $row = $this->transformRow($row);
        }

        return $data;
    }

    /**
     * Transform a single row, decoding json and setting fallback date.
     */
    private function transformRow(array $row): array
    {
        if (isset($row['content']) && is_string($row['content'])) {
            $decoded = json_decode($row['content'], true);
            $row['content'] = is_array($decoded) ? $decoded : [$row['content']];
        }

        if (isset($row['tags']) && is_string($row['tags'])) {
            $decoded = json_decode($row['tags'], true);
            $row['tags'] = is_array($decoded) ? $decoded : [];
        }

        if (isset($row['key_takeaways']) && is_string($row['key_takeaways'])) {
            $decoded = json_decode($row['key_takeaways'], true);
            $row['key_takeaways'] = is_array($decoded) ? $decoded : [];
        }

        // Provide compatibility with view expecting 'date'
        if (!isset($row['date'])) {
            $row['date'] = $row['date_formatted'] ?? date('d F Y', strtotime($row['published_at'] ?? 'now'));
        }

        return $row;
    }
}

