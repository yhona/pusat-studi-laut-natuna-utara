<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KlasterRisetModel;

class Home extends BaseController
{
    protected BeritaModel $beritaModel;
    protected KlasterRisetModel $klasterModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->klasterModel = new KlasterRisetModel();
    }

    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        // Load latest 3 news items from database
        $dbArticles = $this->beritaModel->orderBy('published_at', 'DESC')->findAll(3);
        $latestNews = [];
        foreach ($dbArticles as $art) {
            $latestNews[] = [
                'title'    => $art['title'],
                'category' => $art['category'],
                'date'     => $art['date'] ?? $art['date_formatted'],
                'author'   => $art['author'],
                'excerpt'  => $art['excerpt'],
                'slug'     => $art['slug'],
                'image'    => base_url($art['image']),
            ];
        }

        // Load clusters dynamically from database with bilingual translation
        $dbClusters = $this->klasterModel->findAll();
        $clusters = [];
        foreach ($dbClusters as $c) {
            $title = $c['short_title'] ?? $c['title'];
            $desc = mb_strimwidth($c['mandate'], 0, 160, '...');

            if ($isEn) {
                if ($c['slug'] === 'hukum-laut') {
                    $title = lang('App.cluster_1_title');
                    $desc = lang('App.cluster_1_desc');
                } elseif ($c['slug'] === 'logistik') {
                    $title = lang('App.cluster_2_title');
                    $desc = lang('App.cluster_2_desc');
                } elseif ($c['slug'] === 'ketahanan-digital') {
                    $title = lang('App.cluster_3_title');
                    $desc = lang('App.cluster_3_desc');
                } elseif ($c['slug'] === 'energi') {
                    $title = lang('App.cluster_4_title');
                    $desc = lang('App.cluster_4_desc');
                }
            }

            $clusters[] = [
                'id'    => $c['slug'],
                'icon'  => $c['icon'],
                'title' => $title,
                'desc'  => $desc,
                'lead'  => $c['coordinator']['name'] ?? 'Tim Riset PSK UMRAH',
            ];
        }

        // Bilingual Hero Banners Slider
        $banners = $isEn ? [
            [
                'badge' => 'Strategic Border Focus of Indonesia',
                'title' => 'Maritime Sovereignty & Oceanographic Exploration of North Natuna Sea in South China Sea Dynamics',
                'desc'  => 'A premier center of scientific excellence in international ocean law (UNCLOS 1982), outermost EEZ hydrodynamics monitoring, and archipelagic resilience across the Natuna-Anambas border islands.',
                'link'  => base_url('riset/hukum-laut'),
                'tag'   => 'Natuna & LCS 2026',
                'image' => base_url('images/hero_ship.jpg')
            ],
            [
                'badge' => 'Geopolitical Policy Strategy',
                'title' => 'Policy Brief: Strengthening Sovereignty & EEZ Governance of the North Natuna Sea amid South China Sea Dynamics',
                'desc'  => 'Strategic recommendations for integrated marine spatial surveillance, continental shelf boundaries, and protection of national fishing fleets in outermost Indonesian waters.',
                'link'  => base_url('publikasi#policy-brief'),
                'tag'   => 'Special Policy Brief',
                'image' => base_url('images/batimetri_survey.jpg')
            ],
            [
                'badge' => 'International Conference',
                'title' => 'The 4th International Conference on South China Sea Dynamics, Malacca Strait & Archipelago Security',
                'desc'  => 'Inviting oceanography researchers, world law of the sea experts, and maritime policymakers to discuss regional water stability.',
                'link'  => base_url('berita'),
                'tag'   => 'Global Conference',
                'image' => base_url('images/mangrove_research.jpg')
            ],
        ] : [
            [
                'badge' => 'Fokus Strategis Perbatasan NKRI',
                'title' => 'Kedaulatan Maritim & Eksplorasi Oseanografi Laut Natuna Utara di Pusaran Laut Cina Selatan',
                'desc'  => 'Pusat keunggulan sains terdepan dalam kajian hukum laut internasional (UNCLOS 1982), pemantauan hidrodinamika ZEE terluar, serta ketahanan maritim gugus kepulauan terdepan Natuna-Anambas.',
                'link'  => base_url('riset/hukum-laut'),
                'tag'   => 'Natuna & LCS 2026',
                'image' => base_url('images/hero_ship.jpg')
            ],
            [
                'badge' => 'Kebijakan Strategis Geopolitik',
                'title' => 'Policy Brief: Penguatan Kedaulatan & Tata Kelola ZEE Laut Natuna Utara Terhadap Dinamika Laut Cina Selatan',
                'desc'  => 'Rekomendasi strategis pengawasan ruang laut terpadu, batas landas kontinen, dan perlindungan armada perikanan nasional di perairan terluar Indonesia.',
                'link'  => base_url('publikasi#policy-brief'),
                'tag'   => 'Policy Brief Khusus',
                'image' => base_url('images/batimetri_survey.jpg')
            ],
            [
                'badge' => 'Konferensi Internasional',
                'title' => 'The 4th International Conference on South China Sea Dynamics, Malacca Strait & Archipelago Security',
                'desc'  => 'Mengundang periset oseanografi, pakar hukum laut dunia, dan pembuat kebijakan maritim mendiskusikan stabilitas perairan kawasan.',
                'link'  => base_url('berita'),
                'tag'   => 'Konferensi Global',
                'image' => base_url('images/mangrove_research.jpg')
            ],
        ];

        // Counter Statistik Capaian Riset (Bilingual)
        $stats = $isEn ? [
            ['number' => '142+', 'label' => 'Reputable Scopus / SINTA Publications', 'icon' => 'fa-book-open-reader'],
            ['number' => '28',   'label' => 'Intellectual Property Rights & Maritime Patents', 'icon' => 'fa-certificate'],
            ['number' => '35',   'label' => 'Strategic National & International Partners', 'icon' => 'fa-handshake-angle'],
            ['number' => '21',   'label' => 'Fostered Outermost Small Islands (PPKT) in Natuna-Kepri', 'icon' => 'fa-anchor-circle-check'],
        ] : [
            ['number' => '142+', 'label' => 'Publikasi Scopus / SINTA Bereputasi', 'icon' => 'fa-book-open-reader'],
            ['number' => '28',   'label' => 'Hak Kekayaan Intelektual & Paten Maritim', 'icon' => 'fa-certificate'],
            ['number' => '35',   'label' => 'Mitra Kerjasama Strategis Dalam & Luar Negeri', 'icon' => 'fa-handshake-angle'],
            ['number' => '21',   'label' => 'Pulau-Pulau Kecil Terluar (PPKT) Binaan di Natuna-Kepri', 'icon' => 'fa-anchor-circle-check'],
        ];

        $data = [
            'title'       => $isEn ? 'Home - North Natuna Sea Research Center UMRAH' : 'Beranda - Pusat Studi Laut Natuna Utara UMRAH',
            'banners'     => $banners,
            'clusters'    => $clusters,
            'stats'       => $stats,
            'latest_news' => $latestNews,
            'partners'    => [
                ['name' => 'Badan Riset dan Inovasi Nasional', 'short' => 'BRIN', 'logo' => base_url('images/partners/logo_brin.svg')],
                ['name' => 'Badan Keamanan Laut Republik Indonesia', 'short' => 'BAKAMLA RI', 'logo' => base_url('images/partners/logo_bakamla.svg')],
                ['name' => 'Kementerian Kelautan dan Perikanan', 'short' => 'KKP RI', 'logo' => base_url('images/partners/logo_kkp.svg')],
                ['name' => 'Pemerintah Provinsi Kepulauan Riau', 'short' => 'Pemprov Kepri', 'logo' => base_url('images/partners/logo_kepri.svg')],
                ['name' => 'Pusat Hidro-Oseanografi TNI AL', 'short' => 'Pushidrosal', 'logo' => base_url('images/partners/logo_pushidrosal.svg')],
                ['name' => 'Universiti Malaysia Terengganu', 'short' => 'UMT Malaysia', 'logo' => base_url('images/partners/logo_umt.svg')],
                ['name' => 'Kementerian PPN / Bappenas', 'short' => 'Bappenas RI', 'logo' => base_url('images/partners/logo_bappenas.svg')],
                ['name' => 'Badan Informasi Geospasial', 'short' => 'BIG', 'logo' => base_url('images/partners/logo_big.svg')],
            ]
        ];

        return view('pages/home', $data);
    }
}
