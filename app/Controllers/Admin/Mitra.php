<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MitraModel;

class Mitra extends BaseController
{
    protected MitraModel $mitraModel;

    public function __construct()
    {
        $this->mitraModel = new MitraModel();
    }

    public function index(): string
    {
        $partners = $this->mitraModel->orderBy('order_seq', 'ASC')->orderBy('id', 'ASC')->findAll();

        $data = [
            'title'    => 'Kelola Mitra Kerjasama Strategis',
            'partners' => $partners,
        ];

        return view('admin/mitra/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Mitra Kerjasama Baru',
        ];

        return view('admin/mitra/create', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $logoPath = trim((string) $this->request->getPost('logo_preset'));
        if (empty($logoPath)) {
            $logoPath = 'images/partners/logo_brin.svg';
        }

        $file = $this->request->getFile('logo');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $allowedExts = ['svg', 'png', 'jpg', 'jpeg', 'webp'];
            if (! in_array(strtolower($file->getClientExtension()), $allowedExts, true)) {
                return redirect()->back()->withInput()->with('error', 'Format logo tidak didukung. Harap unggah berkas SVG, PNG, JPG, atau WebP.');
            }
            if ($file->getSizeByUnit('mb') > 3) {
                return redirect()->back()->withInput()->with('error', 'Ukuran logo maksimal adalah 3MB.');
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/partners', $newName);
            $logoPath = 'images/partners/' . $newName;
        }

        $data = [
            'name'        => trim((string) $this->request->getPost('name')),
            'short_name'  => trim((string) $this->request->getPost('short_name')),
            'category'    => trim((string) $this->request->getPost('category')),
            'logo'        => $logoPath,
            'website_url' => trim((string) $this->request->getPost('website_url')),
            'order_seq'   => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->mitraModel->insert($data);

        return redirect()->to(base_url('admin/mitra'))->with('success', 'Mitra kerjasama berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $partner = $this->mitraModel->find($id);

        if (! $partner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mitra kerjasama tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Mitra: ' . $partner['name'],
            'partner' => $partner,
        ];

        return view('admin/mitra/edit', $data);
    }

    public function update(int $id)
    {
        $partner = $this->mitraModel->find($id);

        if (! $partner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mitra kerjasama tidak ditemukan.');
        }

        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $logoPath = $partner['logo'];
        $preset = trim((string) $this->request->getPost('logo_preset'));
        if (!empty($preset)) {
            $logoPath = $preset;
        }

        $file = $this->request->getFile('logo');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $allowedExts = ['svg', 'png', 'jpg', 'jpeg', 'webp'];
            if (! in_array(strtolower($file->getClientExtension()), $allowedExts, true)) {
                return redirect()->back()->withInput()->with('error', 'Format logo tidak didukung. Harap unggah berkas SVG, PNG, JPG, atau WebP.');
            }
            if ($file->getSizeByUnit('mb') > 3) {
                return redirect()->back()->withInput()->with('error', 'Ukuran logo maksimal adalah 3MB.');
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/partners', $newName);
            $logoPath = 'images/partners/' . $newName;
        }

        $data = [
            'name'        => trim((string) $this->request->getPost('name')),
            'short_name'  => trim((string) $this->request->getPost('short_name')),
            'category'    => trim((string) $this->request->getPost('category')),
            'logo'        => $logoPath,
            'website_url' => trim((string) $this->request->getPost('website_url')),
            'order_seq'   => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->mitraModel->update($id, $data);

        return redirect()->to(base_url('admin/mitra'))->with('success', 'Mitra kerjasama berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $partner = $this->mitraModel->find($id);

        if (! $partner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Mitra kerjasama tidak ditemukan.');
        }

        $this->mitraModel->delete($id);

        return redirect()->to(base_url('admin/mitra'))->with('success', 'Mitra kerjasama berhasil dihapus.');
    }
}
