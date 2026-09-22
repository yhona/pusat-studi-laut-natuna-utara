<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoadmapRisetModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Roadmap extends BaseController
{
    protected RoadmapRisetModel $roadmapModel;

    public function __construct()
    {
        $this->roadmapModel = new RoadmapRisetModel();
    }

    public function index(): string
    {
        $roadmap = $this->roadmapModel->orderBy('order_seq', 'ASC')->orderBy('id', 'ASC')->findAll();

        $data = [
            'title'   => 'Kelola Roadmap Riset & Milestone Kemaritiman',
            'roadmap' => $roadmap,
        ];

        return view('admin/roadmap/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Fase Roadmap Riset',
        ];

        return view('admin/roadmap/create', $data);
    }

    public function store()
    {
        $rules = [
            'phase'  => 'required|max_length[100]',
            'title'  => 'required|max_length[255]',
            'desc'   => 'required',
            'status' => 'required|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'phase'     => trim((string) $this->request->getPost('phase')),
            'title'     => trim((string) $this->request->getPost('title')),
            'title_en'  => trim((string) $this->request->getPost('title_en')),
            'desc'      => trim((string) $this->request->getPost('desc')),
            'desc_en'   => trim((string) $this->request->getPost('desc_en')),
            'status'    => trim((string) $this->request->getPost('status')),
            'status_en' => trim((string) $this->request->getPost('status_en')),
            'order_seq' => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->roadmapModel->insert($data);

        return redirect()->to(base_url('admin/roadmap'))->with('success', 'Fase roadmap riset berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $phase = $this->roadmapModel->find($id);

        if (! $phase) {
            throw PageNotFoundException::forPageNotFound('Fase roadmap tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Roadmap: ' . $phase['title'],
            'phase' => $phase,
        ];

        return view('admin/roadmap/edit', $data);
    }

    public function update(int $id)
    {
        $phase = $this->roadmapModel->find($id);

        if (! $phase) {
            throw PageNotFoundException::forPageNotFound('Fase roadmap tidak ditemukan.');
        }

        $rules = [
            'phase'  => 'required|max_length[100]',
            'title'  => 'required|max_length[255]',
            'desc'   => 'required',
            'status' => 'required|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'phase'     => trim((string) $this->request->getPost('phase')),
            'title'     => trim((string) $this->request->getPost('title')),
            'title_en'  => trim((string) $this->request->getPost('title_en')),
            'desc'      => trim((string) $this->request->getPost('desc')),
            'desc_en'   => trim((string) $this->request->getPost('desc_en')),
            'status'    => trim((string) $this->request->getPost('status')),
            'status_en' => trim((string) $this->request->getPost('status_en')),
            'order_seq' => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->roadmapModel->update($id, $data);

        return redirect()->to(base_url('admin/roadmap'))->with('success', 'Fase roadmap riset berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $phase = $this->roadmapModel->find($id);

        if (! $phase) {
            throw PageNotFoundException::forPageNotFound('Fase roadmap tidak ditemukan.');
        }

        $this->roadmapModel->delete($id);

        return redirect()->to(base_url('admin/roadmap'))->with('success', 'Fase roadmap riset berhasil dihapus.');
    }
}
