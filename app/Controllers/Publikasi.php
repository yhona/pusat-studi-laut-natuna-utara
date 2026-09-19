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
