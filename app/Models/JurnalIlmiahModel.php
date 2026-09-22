<?php

namespace App\Models;

use CodeIgniter\Model;

class JurnalIlmiahModel extends Model
{
    protected $table            = 'jurnal_ilmiah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'slug',
        'name',
        'name_en',
        'indexing',
        'issn',
        'description',
        'description_en',
        'frequency',
        'frequency_en',
        'journal_url',
        'cover_image',
        'order_num',
        'is_active',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[255]',
        'indexing'    => 'required|min_length[2]|max_length[150]',
        'issn'        => 'required|min_length[5]|max_length[100]',
        'journal_url' => 'required|valid_url|max_length[255]',
        'description' => 'required|min_length[10]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama jurnal ilmiah wajib diisi.',
            'min_length' => 'Nama jurnal minimal 3 karakter.',
            'max_length' => 'Nama jurnal maksimal 255 karakter.',
        ],
        'indexing' => [
            'required'   => 'Status indeksasi / akreditasi wajib diisi.',
            'min_length' => 'Indeksasi minimal 2 karakter.',
        ],
        'issn' => [
            'required'   => 'Nomor ISSN wajib diisi.',
            'min_length' => 'Format ISSN minimal 5 karakter.',
        ],
        'journal_url' => [
            'required'  => 'URL portal OJS jurnal wajib diisi.',
            'valid_url' => 'Harap masukkan tautan URL yang valid (menggunakan https:// atau http://).',
        ],
        'description' => [
            'required'   => 'Deskripsi atau fokus & ruang lingkup jurnal wajib diisi.',
            'min_length' => 'Deskripsi minimal 10 karakter.',
        ],
    ];

    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    /**
     * Auto-generate a clean, unique slug from the journal name if not supplied.
     */
    protected function generateSlug(array $data): array
    {
        helper('url');
        if (! empty($data['data']['name'])) {
            $inputSlug = ! empty($data['data']['slug']) ? $data['data']['slug'] : $data['data']['name'];
            $baseSlug  = url_title($inputSlug, '-', true);
            $slug      = $baseSlug;
            $counter   = 1;
            $excludeId = $data['id'][0] ?? null;

            while ($this->isSlugExists($slug, $excludeId)) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $data['data']['slug'] = $slug;
        }

        return $data;
    }

    /**
     * Check if a given slug already exists in the table.
     */
    protected function isSlugExists(string $slug, $excludeId = null): bool
    {
        $builder = $this->builder()->where('slug', $slug);
        if ($excludeId !== null) {
            $builder->where('id !=', $excludeId);
        }

        return $builder->countAllResults() > 0;
    }

    /**
     * Helper to get active journals ordered for public consumption.
     */
    public function getActiveJournals(): array
    {
        return $this->where('is_active', 1)
                    ->orderBy('order_num', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }
}
