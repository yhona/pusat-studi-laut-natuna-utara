<?php

namespace App\Controllers;

class Publikasi extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Publikasi & Policy Brief Kemaritiman - UMRAH',
            
            'policy_briefs' => [
                [
                    'number'=> 'PB-04/PSK-UMRAH/2026',
                    'title' => 'Penguatan Kedaulatan & Tata Kelola ZEE Laut Natuna Utara Terhadap Dinamika Geopolitik Laut Cina Selatan',
                    'year'  => '2026',
                    'author'=> 'Dr. Atika Thahira, S.H., M.H., Dr. Raja Sofyan & Tim Kajian Perbatasan',
                    'desc'  => 'Rekomendasi strategis pengawasan ruang laut terpadu berbasis data satelit, penegakan batas landas kontinen sesuai UNCLOS 1982, serta pemberdayaan armada nelayan tangkap nasional di Natuna Utara.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-01/PSK-UMRAH/2026',
                    'title' => 'Strategi Penguatan Konektivitas Logistik Pesisir & Pengendalian Inflasi Kepulauan di Kepri',
                    'year'  => '2026',
                    'author'=> 'Eng. Fadhil Ramadhan & Tim Kajian Logistik',
                    'desc'  => 'Rekomendasi skema subsidi angkutan laut perintis dan pemanfaatan pelabuhan pengumpan lokal guna menekan disparitas harga antar-pulau.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-03/PSK-UMRAH/2025',
                    'title' => 'Valuasi Ekonomi Karbon Biru Mangrove dan Skema Insentif Konservasi Komunitas Adat Melayu',
                    'year'  => '2025',
                    'author'=> 'Dr. Ir. Hendra Saputra & Tim Blue Carbon',
                    'desc'  => 'Kajian potensi penyerapan karbon di kawasan pesisir Bintan-Karimun dan rekomendasi tata kelola pasar karbon daerah.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-02/PSK-UMRAH/2025',
                    'title' => 'Harmonisasi Tata Ruang Laut Antar-Sektor: Mitigasi Tumpang Tindih Pertambangan Pasir Laut dan Nelayan Tangkap',
                    'year'  => '2025',
                    'author'=> 'Dr. Raja Sofyan & Tim Hukum Maritim',
                    'desc'  => 'Tinjauan hukum UNCLOS 1982 dan UU Cipta Kerja terhadap perlindungan wilayah tangkap tradisional nelayan Kepulauan Riau.',
                    'file'  => '#'
                ],
            ],

            'journals' => [
                [
                    'name'    => 'Jurnal Kemaritiman Nusantara (JKN)',
                    'indexing'=> 'SINTA 2 / Crossref / DOAJ',
                    'issn'    => 'e-ISSN: 2715-8921 | p-ISSN: 2355-6712',
                    'desc'    => 'Memuat artikel hasil penelitian orisinal di bidang oseanografi, teknik kelautan, perikanan tangkap, dan tata kelola pesisir Laut Natuna dan Selat Malaka.',
                    'link'    => 'https://journal.umrah.ac.id'
                ],
                [
                    'name'    => 'Maritime Policy & Archipelago Review (MPAR)',
                    'indexing'=> 'Google Scholar / Garuda / Copernicus',
                    'issn'    => 'e-ISSN: 2828-1120',
                    'desc'    => 'Jurnal internasional yang mengulas kebijakan strategis kelautan, perbatasan maritim, hukum laut UNCLOS 1982, dan geopolitik Laut Cina Selatan.',
                    'link'    => 'https://journal.umrah.ac.id'
                ],
            ]
        ];

        return view('pages/publikasi', $data);
    }
}
