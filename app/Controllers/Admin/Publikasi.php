<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Publikasi extends BaseController
{
    protected string $dataFile;

    public function __construct()
    {
        $this->dataFile = WRITEPATH . 'custom_policy_briefs.json';
    }

    public function index(): string
    {
        // Load default briefs from Publikasi controller logic merged with any saved overrides
        $defaultBriefs = [
            [
                'number' => 'PB-05/PSK-UMRAH/2026',
                'title'  => 'Upaya Pengelolaan Kawasan Perbatasan Untuk Mendukung Strategi Diplomasi Menegakkan Kedaulatan Wilayah Di Laut Natuna Utara',
                'year'   => '2026',
                'author' => 'Dr. Ady Muzwardi dan Tim Pusat Strategi Kebijakan Isu Khusus Dan Analisis Data Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI',
                'desc'   => 'Implementasi pengelolaan kawasan perbatasan untuk mendukung strategi diplomasi menegakkan kedaulatan wilayah di perbatasan terluar Indonesia di Laut Natuna Utara didukung oleh beberapa kebijakan baik dari Kebijakan Pemerintah Pusat dan Pemerintah Daerah.',
            ],
            [
                'number' => 'PB-06/PSK-UMRAH/2026',
                'title'  => 'Optimalisasi Pengembangan Kawasan Perdagangan Bebas Dan Pelabuhan Bebas',
                'year'   => '2026',
                'author' => 'Dr. Ady Muzwardi dan Pusat Strategi Kebijakan Kawasan Asia Pasifik dan Afrika Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI',
                'desc'   => 'Kawasan-kawasan strategis untuk menopang pembangunan ekonomi daerah dan nasional. Kawasan Perdagangan Bebas dan Pelabuhan Bebas (KPBPB) adalah salah satu model yang dikembangkan pemerintah dalam mewujudkan Pembangunan di wilayah perbatasan.',
            ],
        ];

        if (file_exists($this->dataFile)) {
            $custom = json_decode(file_get_contents($this->dataFile), true);
            if (is_array($custom) && !empty($custom)) {
                $defaultBriefs = $custom;
            }
        }

        $data = [
            'title'  => 'Kelola Policy Brief & Publikasi - Admin NNSRC',
            'briefs' => $defaultBriefs,
        ];

        return view('admin/publikasi/index', $data);
    }

    public function updateBrief()
    {
        $numbers = $this->request->getPost('number');
        $titles  = $this->request->getPost('title');
        $years   = $this->request->getPost('year');
        $authors = $this->request->getPost('author');
        $descs   = $this->request->getPost('desc');

        if (! is_array($numbers)) {
            return redirect()->back()->with('error', 'Format data tidak valid.');
        }

        $saved = [];
        for ($i = 0; $i < count($numbers); $i++) {
            if (empty(trim($titles[$i]))) {
                continue;
            }
            $saved[] = [
                'number' => trim((string) $numbers[$i]),
                'title'  => trim((string) $titles[$i]),
                'year'   => trim((string) $years[$i]),
                'author' => trim((string) $authors[$i]),
                'desc'   => trim((string) $descs[$i]),
            ];
        }

        file_put_contents($this->dataFile, json_encode($saved, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        return redirect()->to(base_url('admin/publikasi'))
            ->with('success', 'Naskah Policy Brief berhasil diperbarui!');
    }
}
