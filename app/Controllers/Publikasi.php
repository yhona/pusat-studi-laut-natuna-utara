<?php

namespace App\Controllers;

class Publikasi extends BaseController
{
    public function index(): string
    {
        $isEn = (service('request')->getLocale() === 'en');

        $data = [
            'title' => $isEn ? 'Publications & Maritime Policy Briefs - UMRAH' : 'Publikasi & Policy Brief Kemaritiman - UMRAH',
            
            'policy_briefs' => [
                [
                    'number'=> 'PB-05/PSK-UMRAH/2026',
                    'title' => $isEn 
                        ? 'Border Area Management Efforts to Support Diplomatic Strategy in Enforcing Territorial Sovereignty in the North Natuna Sea'
                        : 'Upaya Pengelolaan Kawasan Perbatasan Untuk Mendukung Strategi Diplomasi Menegakkan Kedaulatan Wilayah Di Laut Natuna Utara',
                    'year'  => '2026',
                    'author'=> $isEn 
                        ? 'Dr. Ady Muzwardi and Team from Center for Policy Strategy on Special Issues and Data Analysis, Foreign Policy Strategy Agency (BSKLN)'
                        : 'Dr. Ady Muzwardi dan Tim Pusat Strategi Kebijakan Isu Khusus Dan Analisis Data Badan Strategi Kebijakan Luar Negeri',
                    'desc'  => $isEn
                        ? 'Implementation of border area management to support diplomatic strategies for enforcing territorial sovereignty in Indonesia\'s outermost borders in the North Natuna Sea supported by policies from both Central and Regional Governments.'
                        : 'Implementasi pengelolaan kawasan perbatasan untuk mendukung strategi diplomasi menegakkan kedaulatan wilayah di perbatasan terluar Indonesia di Laut Natuna Utara didukung oleh beberapa kebijakan baik dari Kebijakan Pemerintah Pusat dan Pemerintah Daerah.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-04/PSK-UMRAH/2026',
                    'title' => $isEn 
                        ? 'Strengthening Sovereignty & EEZ Governance in North Natuna Sea Amidst South China Sea Geopolitics'
                        : 'Penguatan Kedaulatan & Tata Kelola ZEE Laut Natuna Utara Terhadap Dinamika Geopolitik Laut Cina Selatan',
                    'year'  => '2026',
                    'author'=> $isEn 
                        ? 'Dr. Atika Thahira, S.H., M.H., Dr. Raja Sofyan & Border Research Team'
                        : 'Dr. Atika Thahira, S.H., M.H., Dr. Raja Sofyan & Tim Kajian Perbatasan',
                    'desc'  => $isEn
                        ? 'Strategic recommendations for integrated satellite-based maritime surveillance, continental shelf boundary enforcement under UNCLOS 1982, and national fishing fleet empowerment in North Natuna.'
                        : 'Rekomendasi strategis pengawasan ruang laut terpadu berbasis data satelit, penegakan batas landas kontinen sesuai UNCLOS 1982, serta pemberdayaan armada nelayan tangkap nasional di Natuna Utara.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-01/PSK-UMRAH/2026',
                    'title' => $isEn
                        ? 'Coastal Logistics Connectivity Enhancement & Archipelagic Inflation Control Strategy in Kepri'
                        : 'Strategi Penguatan Konektivitas Logistik Pesisir & Pengendalian Inflasi Kepulauan di Kepri',
                    'year'  => '2026',
                    'author'=> $isEn 
                        ? 'Eng. Fadhil Ramadhan & Logistics Research Team'
                        : 'Eng. Fadhil Ramadhan & Tim Kajian Logistik',
                    'desc'  => $isEn
                        ? 'Policy recommendations on pioneer shipping subsidy models and local feeder port infrastructure to mitigate inter-island consumer price disparities.'
                        : 'Rekomendasi skema subsidi angkutan laut perintis dan pemanfaatan pelabuhan pengumpan lokal guna menekan disparitas harga antar-pulau.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-03/PSK-UMRAH/2025',
                    'title' => $isEn
                        ? 'Economic Valuation of Mangrove Blue Carbon and Conservation Incentive Schemes for Malay Indigenous Communities'
                        : 'Valuasi Ekonomi Karbon Biru Mangrove dan Skema Insentif Konservasi Komunitas Adat Melayu',
                    'year'  => '2025',
                    'author'=> $isEn 
                        ? 'Dr. Ir. Hendra Saputra & Blue Carbon Team'
                        : 'Dr. Ir. Hendra Saputra & Tim Blue Carbon',
                    'desc'  => $isEn
                        ? 'Assessment of blue carbon sequestration capacities across Bintan-Karimun coastlines with regulatory guidelines for municipal carbon credits.'
                        : 'Kajian potensi penyerapan karbon di kawasan pesisir Bintan-Karimun dan rekomendasi tata kelola pasar karbon daerah.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-02/PSK-UMRAH/2025',
                    'title' => $isEn
                        ? 'Inter-Sectoral Marine Spatial Planning Harmonization: Mitigating Sand Mining and Artisanal Fishing Conflicts'
                        : 'Harmonisasi Tata Ruang Laut Antar-Sektor: Mitigasi Tumpang Tindih Pertambangan Pasir Laut dan Nelayan Tangkap',
                    'year'  => '2025',
                    'author'=> $isEn 
                        ? 'Dr. Raja Sofyan & Maritime Law Team'
                        : 'Dr. Raja Sofyan & Tim Hukum Maritim',
                    'desc'  => $isEn
                        ? 'Legal appraisal under UNCLOS 1982 and the Job Creation Act regarding safeguards for traditional artisanal fishing territories in Riau Islands.'
                        : 'Tinjauan hukum UNCLOS 1982 dan UU Cipta Kerja terhadap perlindungan wilayah tangkap tradisional nelayan Kepulauan Riau.',
                    'file'  => '#'
                ],
            ],

            'journals' => [
                [
                    'name'    => 'Jurnal Kemaritiman Nusantara (JKN)',
                    'indexing'=> 'SINTA 2 / Crossref / DOAJ',
                    'issn'    => 'e-ISSN: 2715-8921 | p-ISSN: 2355-6712',
                    'desc'    => $isEn
                        ? 'Publishes peer-reviewed original research articles in physical oceanography, marine acoustics, capture fisheries, and coastal governance in the Natuna Sea and Malacca Strait.'
                        : 'Memuat artikel hasil penelitian orisinal di bidang oseanografi, teknik kelautan, perikanan tangkap, dan tata kelola pesisir Laut Natuna dan Selat Malaka.',
                    'link'    => 'https://journal.umrah.ac.id'
                ],
                [
                    'name'    => 'Maritime Policy & Archipelago Review (MPAR)',
                    'indexing'=> 'Google Scholar / Garuda / Copernicus',
                    'issn'    => 'e-ISSN: 2828-1120',
                    'desc'    => $isEn
                        ? 'International scholarly journal dedicated to strategic marine policies, island logistics, UNCLOS 1982 jurisprudence, and South China Sea regional geopolitics.'
                        : 'Jurnal internasional yang mengulas kebijakan strategis kelautan, perbatasan maritim, hukum laut UNCLOS 1982, dan geopolitik Laut Cina Selatan.',
                    'link'    => 'https://journal.umrah.ac.id'
                ],
            ]
        ];

        return view('pages/publikasi', $data);
    }
}
