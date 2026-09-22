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
        $sambutan = $this->sambutanModel->first();

        if (! $sambutan) {
            // Seed a default record if empty
            $now = date('Y-m-d H:i:s');
            $default = [
                'name'       => 'Dr. Atika Thahira, S.H., M.H.',
                'title'      => 'Koordinator Pusat Studi Laut Natuna Utara UMRAH',
                'title_en'   => 'Center Coordinator of North Natuna Sea Research Center UMRAH',
                'heading'    => 'Mengokohkan Kedaulatan Bahari Melalui Riset Saintifik & Diplomasi Maritim Laut Natuna Utara',
                'heading_en' => 'Strengthening Maritime Sovereignty Through Scientific Rigor & Ocean Diplomacy in the North Natuna Sea',
                'quote'      => '"Kepulauan Riau dengan gugus kepulauan terluar Natuna-Anambas dan perairan Selat Malaka berhadapan langsung dengan episentrum dinamika geopolitik Laut Cina Selatan. Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH memegang mandat moral dan akademis sebagai garda terdepan sains kebaharian, pemantauan oseanografi ZEE, serta penegakan hukum UNCLOS 1982 demi menjaga kedaulatan laut ibu pertiwi."',
                'quote_en'   => '"Riau Islands with its outermost Natuna-Anambas archipelago and the Malacca Strait faces the epicenter of South China Sea geopolitics. North Natuna Sea Research Center UMRAH carries a moral and scientific mandate to safeguard sovereign waters through oceanographic monitoring and UNCLOS 1982 enforcement."',
                'content'    => 'Sebagai universitas negeri berkarakter kemaritiman di perbatasan utara Indonesia, kami mendedikasikan riset terapan untuk memperkuat data batimetri dasar laut, ketahanan pangan nelayan tradisional di perbatasan, pemodelan arus lintas laut lepas, hingga perlindungan kedaulatan pulau-pulau kecil terluar (PPKT).',
                'content_en' => 'As a public university defined by its maritime character on Indonesia northern border, we dedicate applied research to seafloor bathymetric mapping, traditional border fisheries resilience, cross-sea current modeling, and small island conservation.',
                'image'      => 'images/kepala_pusat.jpg',
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $id = $this->sambutanModel->insert($default);
            $sambutan = $this->sambutanModel->find($id);
        }

        $data = [
            'title'    => 'Kelola Sambutan Pimpinan / Koordinator',
            'sambutan' => $sambutan,
        ];

        return view('admin/sambutan/index', $data);
    }

    public function update()
    {
        $sambutan = $this->sambutanModel->first();
        $id = $sambutan ? $sambutan['id'] : null;

        $rules = [
            'name'    => 'required|max_length[255]',
            'title'   => 'required|max_length[255]',
            'quote'   => 'required',
            'content' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $sambutan ? $sambutan['image'] : 'images/kepala_pusat.jpg';

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
            if ($sambutan && !empty($sambutan['image']) && $sambutan['image'] !== 'images/kepala_pusat.jpg') {
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

        if ($id) {
            $this->sambutanModel->update($id, $data);
        } else {
            $this->sambutanModel->insert($data);
        }

        return redirect()->to(base_url('admin/sambutan'))->with('success', 'Sambutan pimpinan berhasil diperbarui.');
    }
}
