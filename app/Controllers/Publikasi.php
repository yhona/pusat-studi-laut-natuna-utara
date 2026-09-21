<?php

namespace App\Controllers;

class Publikasi extends BaseController
{
    public function index(): string
    {
        $isEn = (service('request')->getLocale() === 'en');

        $briefModel = new \App\Models\PublikasiBriefModel();
        $dbBriefs = $briefModel->where('is_published', 1)->orderBy('year', 'DESC')->findAll();

        $defaultBriefs = [];
        if (!empty($dbBriefs)) {
            foreach ($dbBriefs as $b) {
                $defaultBriefs[] = [
                    'id'        => $b['id'],
                    'number'    => $b['number'],
                    'title'     => ($isEn && !empty($b['title_en'])) ? $b['title_en'] : $b['title'],
                    'year'      => $b['year'],
                    'author'    => ($isEn && !empty($b['author_en'])) ? $b['author_en'] : $b['author'],
                    'desc'      => ($isEn && !empty($b['desc_en'])) ? $b['desc_en'] : $b['desc'],
                    'file'      => !empty($b['file_path']) ? base_url($b['file_path']) : '#',
                ];
            }
        } else {
            $defaultBriefs = [
                [
                    'number'=> 'PB-05/PSK-UMRAH/2026',
                    'title' => $isEn 
                        ? 'Border Area Management Efforts to Support Diplomatic Strategy in Enforcing Territorial Sovereignty in the North Natuna Sea'
                        : 'Upaya Pengelolaan Kawasan Perbatasan Untuk Mendukung Strategi Diplomasi Menegakkan Kedaulatan Wilayah Di Laut Natuna Utara',
                    'year'  => '2026',
                    'author'=> $isEn 
                        ? 'Dr. Ady Muzwardi and Team from Center for Policy Strategy on Special Issues and Data Analysis, Foreign Policy Strategy Agency, Ministry of Foreign Affairs of the Republic of Indonesia'
                        : 'Dr. Ady Muzwardi dan Tim Pusat Strategi Kebijakan Isu Khusus Dan Analisis Data Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI',
                    'desc'  => $isEn
                        ? 'Implementation of border area management to support diplomatic strategies for enforcing territorial sovereignty in Indonesia\'s outermost borders in the North Natuna Sea supported by policies from both Central and Regional Governments.'
                        : 'Implementasi pengelolaan kawasan perbatasan untuk mendukung strategi diplomasi menegakkan kedaulatan wilayah di perbatasan terluar Indonesia di Laut Natuna Utara didukung oleh beberapa kebijakan baik dari Kebijakan Pemerintah Pusat dan Pemerintah Daerah.',
                    'file'  => '#'
                ],
                [
                    'number'=> 'PB-06/PSK-UMRAH/2026',
                    'title' => $isEn 
                        ? 'Optimization of Free Trade Zone and Free Port Development'
                        : 'Optimalisasi Pengembangan Kawasan Perdagangan Bebas Dan Pelabuhan Bebas',
                    'year'  => '2026',
                    'author'=> $isEn 
                        ? 'Dr. Ady Muzwardi and Center for Policy Strategy for Asia Pacific and Africa Region, Foreign Policy Strategy Agency, Ministry of Foreign Affairs of the Republic of Indonesia'
                        : 'Dr. Ady Muzwardi dan Pusat Strategi Kebijakan Kawasan Asia Pasifik dan Afrika Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI',
                    'desc'  => $isEn
                        ? 'Strategic zones to support regional and national economic development. Free Trade Zone and Free Port (KPBPB) is one of the models developed by the government in realizing development in border areas.'
                        : 'Kawasan-kawasan strategis untuk menopang pembangunan ekonomi daerah dan nasional. Kawasan Perdagangan Bebas dan Pelabuhan Bebas (KPBPB) adalah salah satu model yang dikembangkan pemerintah dalam mewujudkan Pembangunan di wilayah perbatasan.',
                    'file'  => '#'
                ],
            ];
        }

        $data = [
            'title' => $isEn ? 'Publications & Maritime Policy Briefs - UMRAH' : 'Publikasi & Policy Brief Kemaritiman - UMRAH',
            'policy_briefs' => $defaultBriefs,

            'journals' => [
                [
                    'name'    => 'Jurnal Akuatiklestari',
                    'indexing'=> 'SINTA 3 / Crossref / Garuda',
                    'issn'    => 'e-ISSN: 2598-8204',
                    'desc'    => $isEn
                        ? 'Accredited SINTA 3 scholarly journal managed by Aquatic Resources Management, FIKP UMRAH. Focuses on marine ecology, tropical oceanography, marine water quality, conservation, and coastal ecosystem governance.'
                        : 'Jurnal ilmiah terakreditasi SINTA 3 yang dikelola Program Studi Manajemen Sumberdaya Perairan, FIKP UMRAH. Memuat kajian ekologi laut tropis, oseanografi, mutu air laut, konservasi, dan tata kelola pesisir.',
                    'link'    => 'https://ojs.umrah.ac.id/index.php/akuatiklestari'
                ],
                [
                    'name'    => 'Khidmat: Journal of Community Service',
                    'indexing'=> 'Google Scholar / Garuda / Crossref',
                    'issn'    => 'e-ISSN: 2684-8244 | p-ISSN: 2598-5035',
                    'desc'    => $isEn
                        ? 'Official journal published by the Center for Maritime Policy and Governance Studies (CMPGS) / LPPM UMRAH. Dedicated to maritime community empowerment, coastal economics, and marine public policy dissemination.'
                        : 'Jurnal resmi terbitan Pusat Studi Kebijakan dan Tata Kelola Kemaritiman / LPPM UMRAH. Memuat diseminasi riset pengabdian masyarakat pesisir, pemberdayaan ekonomi nelayan, dan advokasi kebijakan kelautan.',
                    'link'    => 'https://ojs.umrah.ac.id/index.php/khidmat'
                ],
                [
                    'name'    => 'Jurnal Marinade',
                    'indexing'=> 'Google Scholar / Garuda / Crossref',
                    'issn'    => 'e-ISSN: 2654-4415',
                    'desc'    => $isEn
                        ? 'Scientific journal managed by Marine Fisheries Product Technology, FIKP UMRAH. Covers marine biotechnology, post-harvest fishery processing, seafood food safety, and coastal marine bioproducts.'
                        : 'Jurnal ilmiah kelautan yang dikelola Program Studi Teknologi Hasil Perikanan, FIKP UMRAH. Berfokus pada bioteknologi perikanan bahari, pascapanen tangkapan laut, diversifikasi pangan, dan bioproduk pesisir.',
                    'link'    => 'https://ojs.umrah.ac.id/index.php/marinade'
                ],
                [
                    'name'    => 'Intek Akuakultur',
                    'indexing'=> 'Google Scholar / Garuda / Moraref',
                    'issn'    => 'e-ISSN: 2579-6291',
                    'desc'    => $isEn
                        ? 'Peer-reviewed journal managed by Aquaculture Department, FIKP UMRAH. Publishes empirical investigations on tropical marine aquaculture, hatchery technology, marine feed formulation, and aquatic health.'
                        : 'Jurnal telaah sejawat yang dikelola Program Studi Budidaya Perairan, FIKP UMRAH. Memuat artikel ilmiah teknologi budidaya laut tropis, rekayasa pembenihan biota laut, pakan maritim, dan kesehatan lingkungan perairan.',
                    'link'    => 'https://ojs.umrah.ac.id/index.php/intek'
                ],
            ]
        ];

        return view('pages/publikasi', $data);
    }
}
