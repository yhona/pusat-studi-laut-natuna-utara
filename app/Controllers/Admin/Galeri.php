<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GaleriRisetModel;

class Galeri extends BaseController
{
    protected GaleriRisetModel $galeriModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriRisetModel();
    }

    public function index(): string
    {
        $items = $this->galeriModel->orderBy('order_seq', 'ASC')->orderBy('id', 'ASC')->findAll();

        $data = [
            'title' => 'Kelola Galeri Dokumentasi Ekspedisi & Riset',
            'items' => $items,
        ];

        return view('admin/galeri/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Dokumentasi Galeri Baru',
        ];

        return view('admin/galeri/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'     => 'required|min_length[3]|max_length[255]',
            'category'  => 'required',
            'date_text' => 'required',
            'location'  => 'required',
            'desc'      => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = trim((string) $this->request->getPost('image_preset'));
        if (empty($imagePath)) {
            $imagePath = 'images/hero_ship.jpg';
        }

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            if (! in_array($file->getMimeType(), $allowedMimes, true)) {
                return redirect()->back()->withInput()->with('error', 'Format gambar tidak didukung. Harap unggah JPG, PNG, atau WebP.');
            }
            if ($file->getSizeByUnit('mb') > 5) {
                return redirect()->back()->withInput()->with('error', 'Ukuran gambar maksimal adalah 5MB.');
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images', $newName);
            $imagePath = 'images/' . $newName;
        }

        $data = [
            'title'        => trim((string) $this->request->getPost('title')),
            'title_en'     => trim((string) $this->request->getPost('title_en')),
            'category'     => trim((string) $this->request->getPost('category')),
            'image'        => $imagePath,
            'date_text'    => trim((string) $this->request->getPost('date_text')),
            'date_text_en' => trim((string) $this->request->getPost('date_text_en')),
            'location'     => trim((string) $this->request->getPost('location')),
            'location_en'  => trim((string) $this->request->getPost('location_en')),
            'vessel'       => trim((string) $this->request->getPost('vessel')),
            'vessel_en'    => trim((string) $this->request->getPost('vessel_en')),
            'focal'        => trim((string) $this->request->getPost('focal')),
            'focal_en'     => trim((string) $this->request->getPost('focal_en')),
            'desc'         => trim((string) $this->request->getPost('desc')),
            'desc_en'      => trim((string) $this->request->getPost('desc_en')),
            'order_seq'    => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->galeriModel->insert($data);

        return redirect()->to(base_url('admin/galeri'))->with('success', 'Dokumentasi riset berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $item = $this->galeriModel->find($id);

        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumentasi galeri tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Galeri: ' . $item['title'],
            'item'  => $item,
        ];

        return view('admin/galeri/edit', $data);
    }

    public function update(int $id)
    {
        $item = $this->galeriModel->find($id);

        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumentasi galeri tidak ditemukan.');
        }

        $rules = [
            'title'     => 'required|min_length[3]|max_length[255]',
            'category'  => 'required',
            'date_text' => 'required',
            'location'  => 'required',
            'desc'      => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $item['image'];
        $preset = trim((string) $this->request->getPost('image_preset'));
        if (!empty($preset)) {
            $imagePath = $preset;
        }

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            if (! in_array($file->getMimeType(), $allowedMimes, true)) {
                return redirect()->back()->withInput()->with('error', 'Format gambar tidak didukung. Harap unggah JPG, PNG, atau WebP.');
            }
            if ($file->getSizeByUnit('mb') > 5) {
                return redirect()->back()->withInput()->with('error', 'Ukuran gambar maksimal adalah 5MB.');
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images', $newName);
            $imagePath = 'images/' . $newName;
        }

        $data = [
            'title'        => trim((string) $this->request->getPost('title')),
            'title_en'     => trim((string) $this->request->getPost('title_en')),
            'category'     => trim((string) $this->request->getPost('category')),
            'image'        => $imagePath,
            'date_text'    => trim((string) $this->request->getPost('date_text')),
            'date_text_en' => trim((string) $this->request->getPost('date_text_en')),
            'location'     => trim((string) $this->request->getPost('location')),
            'location_en'  => trim((string) $this->request->getPost('location_en')),
            'vessel'       => trim((string) $this->request->getPost('vessel')),
            'vessel_en'    => trim((string) $this->request->getPost('vessel_en')),
            'focal'        => trim((string) $this->request->getPost('focal')),
            'focal_en'     => trim((string) $this->request->getPost('focal_en')),
            'desc'         => trim((string) $this->request->getPost('desc')),
            'desc_en'      => trim((string) $this->request->getPost('desc_en')),
            'order_seq'    => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->galeriModel->update($id, $data);

        return redirect()->to(base_url('admin/galeri'))->with('success', 'Dokumentasi riset berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $item = $this->galeriModel->find($id);

        if (! $item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumentasi galeri tidak ditemukan.');
        }

        $this->galeriModel->delete($id);

        return redirect()->to(base_url('admin/galeri'))->with('success', 'Dokumentasi riset berhasil dihapus.');
    }
}
