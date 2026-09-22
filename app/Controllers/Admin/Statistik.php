<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CapaianStatistikModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Statistik extends BaseController
{
    protected CapaianStatistikModel $statistikModel;

    public function __construct()
    {
        $this->statistikModel = new CapaianStatistikModel();
    }

    public function index(): string
    {
        $stats = $this->statistikModel->orderBy('order_seq', 'ASC')->orderBy('id', 'ASC')->findAll();

        $data = [
            'title' => 'Kelola Statistik & KPI Capaian Riset',
            'stats' => $stats,
        ];

        return view('admin/statistik/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Statistik Capaian Riset',
        ];

        return view('admin/statistik/create', $data);
    }

    public function store()
    {
        $rules = [
            'number' => 'required|max_length[50]',
            'label'  => 'required|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $icon = trim((string) $this->request->getPost('icon'));
        if (empty($icon)) {
            $icon = 'fa-chart-line';
        }

        $data = [
            'number'    => trim((string) $this->request->getPost('number')),
            'label'     => trim((string) $this->request->getPost('label')),
            'label_en'  => trim((string) $this->request->getPost('label_en')),
            'icon'      => $icon,
            'order_seq' => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->statistikModel->insert($data);

        return redirect()->to(base_url('admin/statistik'))->with('success', 'Statistik capaian berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $stat = $this->statistikModel->find($id);

        if (! $stat) {
            throw PageNotFoundException::forPageNotFound('Statistik tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Statistik: ' . $stat['label'],
            'stat'  => $stat,
        ];

        return view('admin/statistik/edit', $data);
    }

    public function update(int $id)
    {
        $stat = $this->statistikModel->find($id);

        if (! $stat) {
            throw PageNotFoundException::forPageNotFound('Statistik tidak ditemukan.');
        }

        $rules = [
            'number' => 'required|max_length[50]',
            'label'  => 'required|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $icon = trim((string) $this->request->getPost('icon'));
        if (empty($icon)) {
            $icon = $stat['icon'] ?? 'fa-chart-line';
        }

        $data = [
            'number'    => trim((string) $this->request->getPost('number')),
            'label'     => trim((string) $this->request->getPost('label')),
            'label_en'  => trim((string) $this->request->getPost('label_en')),
            'icon'      => $icon,
            'order_seq' => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->statistikModel->update($id, $data);

        return redirect()->to(base_url('admin/statistik'))->with('success', 'Statistik capaian berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $stat = $this->statistikModel->find($id);

        if (! $stat) {
            throw PageNotFoundException::forPageNotFound('Statistik tidak ditemukan.');
        }

        $this->statistikModel->delete($id);

        return redirect()->to(base_url('admin/statistik'))->with('success', 'Statistik capaian berhasil dihapus.');
    }
}
