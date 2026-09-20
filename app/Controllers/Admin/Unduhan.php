<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UnduhanModel;

class Unduhan extends BaseController
{
    protected UnduhanModel $unduhanModel;

    public function __construct()
    {
        $this->unduhanModel = new UnduhanModel();
    }

    public function index(): string
    {
        $documents = $this->unduhanModel->orderBy('id', 'ASC')->findAll();

        $data = [
            'title'     => 'Kelola Repositori & SOP Unduhan - Admin NNSRC',
            'documents' => $documents,
        ];

        return view('admin/unduhan/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Dokumen Repositori Baru - Admin NNSRC',
        ];

        return view('admin/unduhan/create', $data);
    }

    public function store()
    {
        $title    = trim((string) $this->request->getPost('title'));
        $code     = trim((string) $this->request->getPost('code'));
        $slug     = url_title(strtolower($title), '-', true);
        $catId    = trim((string) $this->request->getPost('category_id'));
        $fileType = strtoupper(trim((string) $this->request->getPost('file_type')));
        $fileSize = trim((string) $this->request->getPost('file_size'));
        $year     = trim((string) $this->request->getPost('year'));
        $desc     = trim((string) $this->request->getPost('desc'));

        $categoryNames = [
            'sop'          => 'SOP Laboratorium',
            'policy-brief' => 'Policy Brief',
            'template'     => 'Template Kerjasama',
            'panduan'      => 'Panduan Riset',
        ];

        $saveData = [
            'code'        => $code,
            'slug'        => $slug,
            'title'       => $title,
            'category'    => $categoryNames[$catId] ?? 'Dokumen Resmi',
            'category_id' => $catId,
            'file_type'   => $fileType ?: 'PDF',
            'file_size'   => $fileSize ?: '2.5 MB',
            'year'        => $year ?: date('Y'),
            'downloads'   => 0,
            'desc'        => $desc,
        ];

        if (! $this->unduhanModel->save($saveData)) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan dokumen baru.');
        }

        return redirect()->to(base_url('admin/unduhan'))
            ->with('success', 'Dokumen berhasil ditambahkan ke repositori unduhan!');
    }

    public function edit(int $id): string
    {
        $doc = $this->unduhanModel->find($id);
        if (! $doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumen tidak ditemukan.');
        }

        $data = [
            'title' => 'Sunting Dokumen: ' . $doc['code'],
            'doc'   => $doc,
        ];

        return view('admin/unduhan/edit', $data);
    }

    public function update(int $id)
    {
        $doc = $this->unduhanModel->find($id);
        if (! $doc) {
            return redirect()->to(base_url('admin/unduhan'))->with('error', 'Dokumen tidak ditemukan.');
        }

        $catId = trim((string) $this->request->getPost('category_id'));
        $categoryNames = [
            'sop'          => 'SOP Laboratorium',
            'policy-brief' => 'Policy Brief',
            'template'     => 'Template Kerjasama',
            'panduan'      => 'Panduan Riset',
        ];

        $updateData = [
            'id'          => $id,
            'code'        => trim((string) $this->request->getPost('code')),
            'title'       => trim((string) $this->request->getPost('title')),
            'category'    => $categoryNames[$catId] ?? 'Dokumen Resmi',
            'category_id' => $catId,
            'file_type'   => strtoupper(trim((string) $this->request->getPost('file_type'))),
            'file_size'   => trim((string) $this->request->getPost('file_size')),
            'year'        => trim((string) $this->request->getPost('year')),
            'desc'        => trim((string) $this->request->getPost('desc')),
        ];

        if (! $this->unduhanModel->save($updateData)) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data dokumen.');
        }

        return redirect()->to(base_url('admin/unduhan'))
            ->with('success', 'Data dokumen repositori berhasil diperbarui!');
    }

    public function delete(int $id)
    {
        $this->unduhanModel->delete($id);
        return redirect()->to(base_url('admin/unduhan'))
            ->with('success', 'Dokumen berhasil dihapus dari repositori.');
    }
}
