<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LayananKonsultasiModel;

class Layanan extends BaseController
{
    protected LayananKonsultasiModel $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananKonsultasiModel();
    }

    public function index(): string
    {
        $services = $this->layananModel->orderBy('order_num', 'ASC')->orderBy('id', 'ASC')->findAll();

        $data = [
            'title'    => 'Kelola Layanan & Jasa Konsultasi Kemaritiman',
            'services' => $services,
        ];

        return view('admin/layanan/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Paket Layanan / Laboratorium Baru',
        ];

        return view('admin/layanan/create', $data);
    }

    public function store()
    {
        $rules = [
            'slug'  => 'required|min_length[3]|max_length[100]|is_unique[layanan_konsultasi.slug]',
            'title' => 'required|min_length[3]|max_length[255]',
            'icon'  => 'required',
            'desc'  => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Process instruments and deliverables array
        $rawInstruments = $this->request->getPost('instruments');
        $instruments = [];
        if (is_array($rawInstruments)) {
            $instruments = array_values(array_filter(array_map('trim', $rawInstruments)));
        }

        $rawDeliverables = $this->request->getPost('deliverables');
        $deliverables = [];
        if (is_array($rawDeliverables)) {
            $deliverables = array_values(array_filter(array_map('trim', $rawDeliverables)));
        }

        $data = [
            'slug'         => url_title($this->request->getPost('slug'), '-', true),
            'icon'         => trim($this->request->getPost('icon')),
            'title'        => trim($this->request->getPost('title')),
            'title_en'     => trim($this->request->getPost('title_en') ?? ''),
            'desc'         => trim($this->request->getPost('desc')),
            'desc_en'      => trim($this->request->getPost('desc_en') ?? ''),
            'code'         => trim($this->request->getPost('code') ?? ''),
            'standards'    => trim($this->request->getPost('standards') ?? ''),
            'sop_name'     => trim($this->request->getPost('sop_name') ?? ''),
            'instruments'  => json_encode($instruments, JSON_UNESCAPED_UNICODE),
            'deliverables' => json_encode($deliverables, JSON_UNESCAPED_UNICODE),
            'order_num'    => (int) ($this->request->getPost('order_num') ?? 0),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->layananModel->insert($data);

        return redirect()->to(base_url('admin/layanan'))->with('success', 'Paket layanan berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $service = $this->layananModel->find($id);

        if (! $service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Paket layanan tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Layanan: ' . $service['title'],
            'service' => $service,
        ];

        return view('admin/layanan/edit', $data);
    }

    public function update(int $id)
    {
        $service = $this->layananModel->find($id);

        if (! $service) {
            return redirect()->to(base_url('admin/layanan'))->with('error', 'Paket layanan tidak ditemukan.');
        }

        $rules = [
            'slug'  => "required|min_length[3]|max_length[100]|is_unique[layanan_konsultasi.slug,id,{$id}]",
            'title' => 'required|min_length[3]|max_length[255]',
            'icon'  => 'required',
            'desc'  => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Process instruments and deliverables array
        $rawInstruments = $this->request->getPost('instruments');
        $instruments = [];
        if (is_array($rawInstruments)) {
            $instruments = array_values(array_filter(array_map('trim', $rawInstruments)));
        }

        $rawDeliverables = $this->request->getPost('deliverables');
        $deliverables = [];
        if (is_array($rawDeliverables)) {
            $deliverables = array_values(array_filter(array_map('trim', $rawDeliverables)));
        }

        $data = [
            'slug'         => url_title($this->request->getPost('slug'), '-', true),
            'icon'         => trim($this->request->getPost('icon')),
            'title'        => trim($this->request->getPost('title')),
            'title_en'     => trim($this->request->getPost('title_en') ?? ''),
            'desc'         => trim($this->request->getPost('desc')),
            'desc_en'      => trim($this->request->getPost('desc_en') ?? ''),
            'code'         => trim($this->request->getPost('code') ?? ''),
            'standards'    => trim($this->request->getPost('standards') ?? ''),
            'sop_name'     => trim($this->request->getPost('sop_name') ?? ''),
            'instruments'  => json_encode($instruments, JSON_UNESCAPED_UNICODE),
            'deliverables' => json_encode($deliverables, JSON_UNESCAPED_UNICODE),
            'order_num'    => (int) ($this->request->getPost('order_num') ?? 0),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->layananModel->update($id, $data);

        return redirect()->to(base_url('admin/layanan'))->with('success', 'Paket layanan berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $service = $this->layananModel->find($id);

        if (! $service) {
            return redirect()->to(base_url('admin/layanan'))->with('error', 'Paket layanan tidak ditemukan.');
        }

        $this->layananModel->delete($id);

        return redirect()->to(base_url('admin/layanan'))->with('success', 'Paket layanan berhasil dihapus.');
    }
}
