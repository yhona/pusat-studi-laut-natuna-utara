<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminActivityLogModel;
use App\Models\JurnalIlmiahModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Jurnal extends BaseController
{
    protected JurnalIlmiahModel $jurnalModel;

    public function __construct()
    {
        $this->jurnalModel = new JurnalIlmiahModel();
    }

    /**
     * List all scientific journals in the admin panel.
     */
    public function index(): string
    {
        $journals = $this->jurnalModel->orderBy('order_num', 'ASC')->orderBy('id', 'ASC')->findAll();

        $totalCount  = count($journals);
        $sintaCount  = 0;
        $activeCount = 0;

        foreach ($journals as $j) {
            if (! empty($j['is_active'])) {
                $activeCount++;
            }
            if (stripos($j['indexing'], 'sinta') !== false) {
                $sintaCount++;
            }
        }

        $data = [
            'title'       => 'Kelola Jurnal Ilmiah Kemaritiman',
            'journals'    => $journals,
            'totalCount'  => $totalCount,
            'sintaCount'  => $sintaCount,
            'activeCount' => $activeCount,
        ];

        return view('admin/jurnal/index', $data);
    }

    /**
     * Show form to create a new journal.
     */
    public function create(): string
    {
        $data = [
            'title' => 'Tambah Jurnal Ilmiah Baru',
        ];

        return view('admin/jurnal/create', $data);
    }

    /**
     * Store newly created journal record.
     */
    public function store()
    {
        $rules = [
            'name'         => 'required|min_length[3]|max_length[255]',
            'indexing'     => 'required|min_length[2]|max_length[150]',
            'issn'         => 'required|min_length[5]|max_length[100]',
            'journal_url'  => 'required|valid_url|max_length[255]',
            'description'  => 'required|min_length[10]',
            'cover_image'  => 'permit_empty|uploaded[cover_image]|max_size[cover_image,4096]|ext_in[cover_image,jpg,jpeg,png,webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $coverPath = null;
        $coverFile = $this->request->getFile('cover_image');
        if ($coverFile && $coverFile->isValid() && ! $coverFile->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/journals';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = $coverFile->getRandomName();
            $coverFile->move($uploadDir, $newName);
            $coverPath = 'uploads/journals/' . $newName;
        }

        $data = [
            'slug'           => trim((string) $this->request->getPost('slug')),
            'name'           => trim((string) $this->request->getPost('name')),
            'name_en'        => trim((string) $this->request->getPost('name_en') ?: $this->request->getPost('name')),
            'indexing'       => trim((string) $this->request->getPost('indexing')),
            'issn'           => trim((string) $this->request->getPost('issn')),
            'description'    => trim((string) $this->request->getPost('description')),
            'description_en' => trim((string) $this->request->getPost('description_en')),
            'frequency'      => trim((string) $this->request->getPost('frequency') ?: 'Terbit 2x Setahun'),
            'frequency_en'   => trim((string) $this->request->getPost('frequency_en') ?: 'Biannual Publication'),
            'journal_url'    => trim((string) $this->request->getPost('journal_url')),
            'cover_image'    => $coverPath,
            'order_num'      => (int) ($this->request->getPost('order_num') ?? 0),
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $insertedId = $this->jurnalModel->insert($data);

        if (! $insertedId) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data jurnal ilmiah baru.');
        }

        AdminActivityLogModel::record(
            'JURNAL_CREATE',
            "Menambahkan jurnal ilmiah baru: {$data['name']} (ID: {$insertedId})"
        );

        return redirect()->to(base_url('admin/jurnal'))->with('success', 'Jurnal ilmiah baru berhasil ditambahkan.');
    }

    /**
     * Show form to edit an existing journal.
     */
    public function edit(int $id): string
    {
        $journal = $this->jurnalModel->find($id);

        if (! $journal) {
            throw PageNotFoundException::forPageNotFound('Data jurnal ilmiah tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Jurnal Ilmiah: ' . $journal['name'],
            'journal' => $journal,
        ];

        return view('admin/jurnal/edit', $data);
    }

    /**
     * Update an existing journal record.
     */
    public function update(int $id)
    {
        $journal = $this->jurnalModel->find($id);

        if (! $journal) {
            return redirect()->to(base_url('admin/jurnal'))->with('error', 'Jurnal ilmiah tidak ditemukan.');
        }

        $rules = [
            'name'         => 'required|min_length[3]|max_length[255]',
            'indexing'     => 'required|min_length[2]|max_length[150]',
            'issn'         => 'required|min_length[5]|max_length[100]',
            'journal_url'  => 'required|valid_url|max_length[255]',
            'description'  => 'required|min_length[10]',
            'cover_image'  => 'permit_empty|uploaded[cover_image]|max_size[cover_image,4096]|ext_in[cover_image,jpg,jpeg,png,webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $coverPath = $journal['cover_image'];
        $coverFile = $this->request->getFile('cover_image');
        if ($coverFile && $coverFile->isValid() && ! $coverFile->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/journals';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $newName = $coverFile->getRandomName();
            $coverFile->move($uploadDir, $newName);
            $coverPath = 'uploads/journals/' . $newName;
        }

        $data = [
            'name'           => trim((string) $this->request->getPost('name')),
            'name_en'        => trim((string) $this->request->getPost('name_en') ?: $this->request->getPost('name')),
            'indexing'       => trim((string) $this->request->getPost('indexing')),
            'issn'           => trim((string) $this->request->getPost('issn')),
            'description'    => trim((string) $this->request->getPost('description')),
            'description_en' => trim((string) $this->request->getPost('description_en')),
            'frequency'      => trim((string) $this->request->getPost('frequency') ?: 'Terbit 2x Setahun'),
            'frequency_en'   => trim((string) $this->request->getPost('frequency_en') ?: 'Biannual Publication'),
            'journal_url'    => trim((string) $this->request->getPost('journal_url')),
            'cover_image'    => $coverPath,
            'order_num'      => (int) ($this->request->getPost('order_num') ?? 0),
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $customSlug = trim((string) $this->request->getPost('slug'));
        if (! empty($customSlug)) {
            $data['slug'] = $customSlug;
        }

        $this->jurnalModel->update($id, $data);

        AdminActivityLogModel::record(
            'JURNAL_UPDATE',
            "Memperbarui data jurnal ilmiah: {$data['name']} (ID: {$id})"
        );

        return redirect()->to(base_url('admin/jurnal'))->with('success', 'Data jurnal ilmiah berhasil diperbarui.');
    }

    /**
     * Delete an existing journal record.
     */
    public function delete(int $id)
    {
        $journal = $this->jurnalModel->find($id);

        if (! $journal) {
            return redirect()->to(base_url('admin/jurnal'))->with('error', 'Jurnal ilmiah tidak ditemukan.');
        }

        $this->jurnalModel->delete($id);

        AdminActivityLogModel::record(
            'JURNAL_DELETE',
            "Menghapus jurnal ilmiah: {$journal['name']} (ID: {$id})"
        );

        return redirect()->to(base_url('admin/jurnal'))->with('success', 'Jurnal ilmiah berhasil dihapus.');
    }
}
