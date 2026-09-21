<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PublikasiBriefModel;

class Publikasi extends BaseController
{
    protected PublikasiBriefModel $publikasiModel;

    public function __construct()
    {
        $this->publikasiModel = new PublikasiBriefModel();
    }

    public function index(): string
    {
        $briefs = $this->publikasiModel->orderBy('year', 'DESC')->orderBy('id', 'DESC')->findAll();

        $data = [
            'title'  => 'Kelola Policy Brief & Publikasi Kemaritiman',
            'briefs' => $briefs,
        ];

        return view('admin/publikasi/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Naskah Policy Brief Baru',
        ];

        return view('admin/publikasi/create', $data);
    }

    public function store()
    {
        $rules = [
            'number'    => 'required|min_length[3]|max_length[100]',
            'title'     => 'required|min_length[5]|max_length[255]',
            'year'      => 'required|exact_length[4]|numeric',
            'author'    => 'required|min_length[3]|max_length[255]',
            'desc'      => 'required',
            'file_pdf'  => 'permit_empty|uploaded[file_pdf]|max_size[file_pdf,20480]|ext_in[file_pdf,pdf]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $filePath = null;
        $file = $this->request->getFile('file_pdf');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/documents', $newName);
            $filePath = 'uploads/documents/' . $newName;
        }

        $data = [
            'number'       => trim($this->request->getPost('number')),
            'type'         => $this->request->getPost('type') ?? 'policy_brief',
            'title'        => trim($this->request->getPost('title')),
            'title_en'     => trim($this->request->getPost('title_en') ?? ''),
            'year'         => trim($this->request->getPost('year')),
            'author'       => trim($this->request->getPost('author')),
            'author_en'    => trim($this->request->getPost('author_en') ?? ''),
            'desc'         => trim($this->request->getPost('desc')),
            'desc_en'      => trim($this->request->getPost('desc_en') ?? ''),
            'file_path'    => $filePath,
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
        ];

        $this->publikasiModel->insert($data);

        return redirect()->to(base_url('admin/publikasi'))->with('success', 'Naskah publikasi berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $brief = $this->publikasiModel->find($id);

        if (! $brief) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Naskah publikasi tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Naskah Policy Brief: ' . $brief['number'],
            'brief' => $brief,
        ];

        return view('admin/publikasi/edit', $data);
    }

    public function update(int $id)
    {
        $brief = $this->publikasiModel->find($id);

        if (! $brief) {
            return redirect()->to(base_url('admin/publikasi'))->with('error', 'Naskah tidak ditemukan.');
        }

        $rules = [
            'number'    => 'required|min_length[3]|max_length[100]',
            'title'     => 'required|min_length[5]|max_length[255]',
            'year'      => 'required|exact_length[4]|numeric',
            'author'    => 'required|min_length[3]|max_length[255]',
            'desc'      => 'required',
            'file_pdf'  => 'permit_empty|uploaded[file_pdf]|max_size[file_pdf,20480]|ext_in[file_pdf,pdf]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $filePath = $brief['file_path'];
        $file = $this->request->getFile('file_pdf');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/documents', $newName);
            $filePath = 'uploads/documents/' . $newName;
        }

        $data = [
            'number'       => trim($this->request->getPost('number')),
            'type'         => $this->request->getPost('type') ?? 'policy_brief',
            'title'        => trim($this->request->getPost('title')),
            'title_en'     => trim($this->request->getPost('title_en') ?? ''),
            'year'         => trim($this->request->getPost('year')),
            'author'       => trim($this->request->getPost('author')),
            'author_en'    => trim($this->request->getPost('author_en') ?? ''),
            'desc'         => trim($this->request->getPost('desc')),
            'desc_en'      => trim($this->request->getPost('desc_en') ?? ''),
            'file_path'    => $filePath,
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
        ];

        $this->publikasiModel->update($id, $data);

        return redirect()->to(base_url('admin/publikasi'))->with('success', 'Naskah publikasi berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $brief = $this->publikasiModel->find($id);

        if (! $brief) {
            return redirect()->to(base_url('admin/publikasi'))->with('error', 'Naskah tidak ditemukan.');
        }

        $this->publikasiModel->delete($id);

        return redirect()->to(base_url('admin/publikasi'))->with('success', 'Naskah publikasi berhasil dihapus.');
    }
}
