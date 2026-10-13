<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SambutanPimpinanModel;

class Sambutan extends BaseController
{
    protected SambutanPimpinanModel $sambutanModel;

    public function __construct()
    {
        $this->sambutanModel = new SambutanPimpinanModel();
    }

    public function index(): string
    {
        $bskln = $this->sambutanModel->where('role_key', 'bskln')->first();
        if (! $bskln) {
            $seeder = new \App\Database\Seeds\SambutanBsklnSeeder();
            $seeder->run();
            $bskln = $this->sambutanModel->where('role_key', 'bskln')->first();
        }

        $koordinator = $this->sambutanModel->where('role_key', 'koordinator')->first()
                    ?? $this->sambutanModel->where('id', 1)->first();

        $activeTab = $this->request->getGet('tab') ?? 'bskln';

        $data = [
            'title'       => 'Kelola Sambutan Pimpinan & Pejabat',
            'bskln'       => $bskln,
            'koordinator' => $koordinator,
            'activeTab'   => in_array($activeTab, ['bskln', 'koordinator'], true) ? $activeTab : 'bskln',
        ];

        return view('admin/sambutan/index', $data);
    }

    public function update($id = null)
    {
        $id = (int) ($this->request->getPost('id') ?: $id);
        $sambutan = $id > 0 ? $this->sambutanModel->find($id) : $this->sambutanModel->first();

        if (! $sambutan) {
            return redirect()->to(base_url('admin/sambutan'))->with('error', 'Data sambutan tidak ditemukan.');
        }

        $rules = [
            'name'    => 'required|max_length[255]',
            'title'   => 'required|max_length[255]',
            'quote'   => 'required',
            'content' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $sambutan['image'];

        $file = $this->request->getFile('image');
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $file->isValid()) {
                return redirect()->back()->withInput()->with('error', 'Gagal mengunggah foto: ' . $file->getErrorString());
            }
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            if (! in_array($file->getMimeType(), $allowedMimes, true)) {
                return redirect()->back()->withInput()->with('error', 'Format berkas tidak didukung. Harap unggah berkas gambar JPG, PNG, atau WebP.');
            }
            if ($file->getSizeByUnit('mb') > 5) {
                return redirect()->back()->withInput()->with('error', 'Ukuran foto maksimal adalah 5MB.');
            }
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images', $newName);
            
            // Clean up previous custom uploaded image (avoid deleting stock default asset)
            $stockImages = ['images/kepala_pusat.jpg', 'images/kepala_bskln.jpg', 'images/rektor_umrah.png'];
            if (!empty($sambutan['image']) && !in_array($sambutan['image'], $stockImages, true)) {
                $oldFile = FCPATH . $sambutan['image'];
                if (file_exists($oldFile) && is_file($oldFile)) {
                    @unlink($oldFile);
                }
            }

            $imagePath = 'images/' . $newName;
        }

        $data = [
            'name'       => trim((string) $this->request->getPost('name')),
            'title'      => trim((string) $this->request->getPost('title')),
            'title_en'   => trim((string) $this->request->getPost('title_en')),
            'heading'    => trim((string) $this->request->getPost('heading')),
            'heading_en' => trim((string) $this->request->getPost('heading_en')),
            'quote'      => trim((string) $this->request->getPost('quote')),
            'quote_en'   => trim((string) $this->request->getPost('quote_en')),
            'content'    => trim((string) $this->request->getPost('content')),
            'content_en' => trim((string) $this->request->getPost('content_en')),
            'image'      => $imagePath,
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->sambutanModel->update($sambutan['id'], $data);

        $tab = $sambutan['role_key'] ?? 'bskln';
        return redirect()->to(base_url('admin/sambutan?tab=' . $tab))->with('success', 'Sambutan ' . esc($data['name']) . ' berhasil diperbarui.');
    }
}
