<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\HeroBannerModel;

class Banner extends BaseController
{
    protected HeroBannerModel $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new HeroBannerModel();
    }

    public function index(): string
    {
        $banners = $this->bannerModel->orderBy('order_seq', 'ASC')->orderBy('id', 'ASC')->findAll();

        $data = [
            'title'   => 'Kelola Banner & Slider Beranda',
            'banners' => $banners,
        ];

        return view('admin/banners/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Banner Slider Baru',
        ];

        return view('admin/banners/create', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'badge' => 'required|max_length[150]',
            'desc'  => 'required',
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
            'badge'      => trim((string) $this->request->getPost('badge')),
            'badge_en'   => trim((string) $this->request->getPost('badge_en')),
            'title'      => trim((string) $this->request->getPost('title')),
            'title_en'   => trim((string) $this->request->getPost('title_en')),
            'desc'       => trim((string) $this->request->getPost('desc')),
            'desc_en'    => trim((string) $this->request->getPost('desc_en')),
            'link_url'   => trim((string) $this->request->getPost('link_url')),
            'tag'        => trim((string) $this->request->getPost('tag')),
            'tag_en'     => trim((string) $this->request->getPost('tag_en')),
            'image'      => $imagePath,
            'order_seq'  => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->bannerModel->insert($data);

        return redirect()->to(base_url('admin/banners'))->with('success', 'Banner slider berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $banner = $this->bannerModel->find($id);

        if (! $banner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Banner slider tidak ditemukan.');
        }

        $data = [
            'title'  => 'Edit Banner: ' . $banner['title'],
            'banner' => $banner,
        ];

        return view('admin/banners/edit', $data);
    }

    public function update(int $id)
    {
        $banner = $this->bannerModel->find($id);

        if (! $banner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Banner slider tidak ditemukan.');
        }

        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'badge' => 'required|max_length[150]',
            'desc'  => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $banner['image'];
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
            'badge'      => trim((string) $this->request->getPost('badge')),
            'badge_en'   => trim((string) $this->request->getPost('badge_en')),
            'title'      => trim((string) $this->request->getPost('title')),
            'title_en'   => trim((string) $this->request->getPost('title_en')),
            'desc'       => trim((string) $this->request->getPost('desc')),
            'desc_en'    => trim((string) $this->request->getPost('desc_en')),
            'link_url'   => trim((string) $this->request->getPost('link_url')),
            'tag'        => trim((string) $this->request->getPost('tag')),
            'tag_en'     => trim((string) $this->request->getPost('tag_en')),
            'image'      => $imagePath,
            'order_seq'  => (int) ($this->request->getPost('order_seq') ?? 0),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->bannerModel->update($id, $data);

        return redirect()->to(base_url('admin/banners'))->with('success', 'Banner slider berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $banner = $this->bannerModel->find($id);

        if (! $banner) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Banner slider tidak ditemukan.');
        }

        $this->bannerModel->delete($id);

        return redirect()->to(base_url('admin/banners'))->with('success', 'Banner slider berhasil dihapus.');
    }
}
