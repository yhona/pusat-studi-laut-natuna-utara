<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profil extends BaseController
{
    protected string $dataFile;

    public function __construct()
    {
        $this->dataFile = WRITEPATH . 'site_profile.json';
    }

    protected function getProfileData(): array
    {
        $default = [
            'mandat_id' => 'Pusat Studi Laut Natuna Utara didirikan untuk memenuhi panggilan tanggung jawab tridharma perguruan tinggi melalui pengembangan kelimuan yang diwujudkan dalam bentuk hasil-hasil penelitian, khususnya selaras dengan upaya mengarus-utamakan mandat pembangunan nasional yang belandaskan Nota Kesepahaman antara Universitas Maritim Raja Ali Haji dan Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri Republik Indonesia tentang kerjasama pendidikan, penelitian dan pengabdian masyarakat di bidang strategi kebijakan luar negeri Nomor PRJ/SJ/00003/03/2023/76/12 dan Nomor 1472/UN53.0/KS.00.00/2023 yang memiliki ruang lingkup Pusat Riset Laut Natuna. Dan yang paling utama, didirikannya Pusat Studi ini merupakan optimalisasi kajian bersama Universitas Maritim Raja Ali Haji dan Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri Republik Indonesia.',
            'mou_kemenlu' => 'PRJ/SJ/00003/03/2023/76/12',
            'mou_umrah'   => '1472/UN53.0/KS.00.00/2023',
            'visi_id'     => 'Menjadi Pusat Unggulan Riset Kemaritiman Tropis & Perbatasan Terdepan di Asia Tenggara Berlandaskan Falsafah Luhur Tamadun Bahari Melayu',
            'gurindam_bait1' => 'Jika hendak mengenal orang yang berilmu, bertanya dan belajar tiadalah jemu.',
            'gurindam_bait2' => 'Jika hendak mengenal orang yang berakal, di dalam dunia mengambil bekal.',
            'misi_1'      => 'Mengaktualisasikan falsafah "tiadalah jemu belajar" melalui riset oseanografi terapan, pemodelan hidrodinamika laut tropis, dan pemetaan ekosistem blue carbon secara konsisten di wilayah perbatasan.',
            'misi_2'      => 'Menghasilkan policy brief dan kajian hukum laut internasional (UNCLOS 1982) sebagai "bekal strategis" diplomasi kedaulatan wilayah NKRI di kawasan Zona Ekonomi Eksklusif (ZEE) Natuna Utara.',
            'misi_3'      => 'Menebarkan manfaat ilmu bagi masyarakat nelayan tradisional melalui alih teknologi tepat guna bahari, diversifikasi pangan laut, dan peningkatan ketahanan ekonomi pulau-pulau perbatasan.',
        ];

        if (file_exists($this->dataFile)) {
            $saved = json_decode(file_get_contents($this->dataFile), true);
            if (is_array($saved)) {
                return array_merge($default, $saved);
            }
        }

        return $default;
    }

    public function index(): string
    {
        $data = [
            'title'   => 'Pengaturan Profil & Visi Misi - Admin NNSRC',
            'profile' => $this->getProfileData(),
        ];

        return view('admin/profil/index', $data);
    }

    public function update()
    {
        $payload = [
            'mandat_id'      => trim($this->request->getPost('mandat_id') ?? ''),
            'mou_kemenlu'    => trim($this->request->getPost('mou_kemenlu') ?? ''),
            'mou_umrah'      => trim($this->request->getPost('mou_umrah') ?? ''),
            'visi_id'        => trim($this->request->getPost('visi_id') ?? ''),
            'gurindam_bait1' => trim($this->request->getPost('gurindam_bait1') ?? ''),
            'gurindam_bait2' => trim($this->request->getPost('gurindam_bait2') ?? ''),
            'misi_1'         => trim($this->request->getPost('misi_1') ?? ''),
            'misi_2'         => trim($this->request->getPost('misi_2') ?? ''),
            'misi_3'         => trim($this->request->getPost('misi_3') ?? ''),
            'updated_at'     => date('Y-m-d H:i:s'),
        ];

        file_put_contents($this->dataFile, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        return redirect()->to(base_url('admin/profil'))
            ->with('success', 'Data Profil, Landasan Hukum MoU, dan Visi Misi Gurindam berhasil diperbarui.');
    }
}
