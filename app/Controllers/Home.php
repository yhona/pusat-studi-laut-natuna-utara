<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KlasterRisetModel;
use App\Models\HeroBannerModel;
use App\Models\MitraModel;
use App\Models\GaleriRisetModel;

class Home extends BaseController
{
    protected BeritaModel $beritaModel;
    protected KlasterRisetModel $klasterModel;
    protected HeroBannerModel $bannerModel;
    protected MitraModel $mitraModel;
    protected GaleriRisetModel $galeriModel;

    public function __construct()
    {
        $this->beritaModel  = new BeritaModel();
        $this->klasterModel = new KlasterRisetModel();
        $this->bannerModel  = new HeroBannerModel();
        $this->mitraModel   = new MitraModel();
        $this->galeriModel  = new GaleriRisetModel();
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

        // Bilingual Hero Banners Slider (Dynamic from Database with Fallback)
        $dbBanners = $this->bannerModel->getActiveBanners();
        $banners = [];
        if (!empty($dbBanners)) {
            foreach ($dbBanners as $b) {
                $link = $b['link_url'] ?? '';
                if (!empty($link) && !str_starts_with($link, 'http://') && !str_starts_with($link, 'https://')) {
                    $link = base_url($link);
                }
                $banners[] = [
                    'badge' => ($isEn && !empty($b['badge_en'])) ? $b['badge_en'] : $b['badge'],
                    'title' => ($isEn && !empty($b['title_en'])) ? $b['title_en'] : $b['title'],
                    'desc'  => ($isEn && !empty($b['desc_en'])) ? $b['desc_en'] : $b['desc'],
                    'link'  => $link ?: base_url('riset'),
                    'tag'   => ($isEn && !empty($b['tag_en'])) ? $b['tag_en'] : ($b['tag'] ?? ''),
                    'image' => base_url($b['image']),
                ];
            }
        } else {
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
        }

        // Mitra Kerjasama Strategis (Dynamic from Database with Fallback)
        $dbPartners = [];
        try {
            $dbPartners = $this->mitraModel->getActivePartners();
        } catch (\Throwable $e) {
            $dbPartners = [];
        }
        $partners = [];
        if (!empty($dbPartners)) {
            foreach ($dbPartners as $p) {
                $partners[] = [
                    'name'  => $p['name'],
                    'short' => !empty($p['short_name']) ? $p['short_name'] : $p['name'],
                    'logo'  => base_url($p['logo']),
                    'url'   => !empty($p['website_url']) ? $p['website_url'] : '#',
                ];
            }
        } else {
            $partners = [
                ['name' => 'Badan Riset dan Inovasi Nasional', 'short' => 'BRIN', 'logo' => base_url('images/partners/logo_brin.svg'), 'url' => 'https://brin.go.id'],
                ['name' => 'Badan Keamanan Laut Republik Indonesia', 'short' => 'BAKAMLA RI', 'logo' => base_url('images/partners/logo_bakamla.svg'), 'url' => 'https://bakamla.go.id'],
                ['name' => 'Kementerian Kelautan dan Perikanan', 'short' => 'KKP RI', 'logo' => base_url('images/partners/logo_kkp.svg'), 'url' => 'https://kkp.go.id'],
                ['name' => 'Pemerintah Provinsi Kepulauan Riau', 'short' => 'Pemprov Kepri', 'logo' => base_url('images/partners/logo_kepri.svg'), 'url' => 'https://kepriprov.go.id'],
                ['name' => 'Pusat Hidro-Oseanografi TNI AL', 'short' => 'Pushidrosal', 'logo' => base_url('images/partners/logo_pushidrosal.svg'), 'url' => 'https://pushidrosal.id'],
                ['name' => 'Universiti Malaysia Terengganu', 'short' => 'UMT Malaysia', 'logo' => base_url('images/partners/logo_umt.svg'), 'url' => 'https://umt.edu.my'],
                ['name' => 'Kementerian PPN / Bappenas', 'short' => 'Bappenas RI', 'logo' => base_url('images/partners/logo_bappenas.svg'), 'url' => 'https://bappenas.go.id'],
                ['name' => 'Badan Informasi Geospasial', 'short' => 'BIG', 'logo' => base_url('images/partners/logo_big.svg'), 'url' => 'https://big.go.id'],
            ];
        }

        // Galeri Riset & Ekspedisi (Dynamic from Database with Fallback)
        $dbGallery = [];
        try {
            $dbGallery = $this->galeriModel->getActiveGallery();
        } catch (\Throwable $e) {
            $dbGallery = [];
        }

        $galleryItems = [];
        if (!empty($dbGallery)) {
            foreach ($dbGallery as $g) {
                $category = $g['category'] ?? 'ekspedisi';
                $badgeClass = 'bg-gold-500/20 text-gold-400 border-gold-500/30';
                $catLabel = $isEn ? 'Sea Expedition' : 'Ekspedisi Laut';

                if ($category === 'blue-carbon') {
                    $badgeClass = 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30';
                    $catLabel = 'Blue Carbon';
                } elseif ($category === 'laboratorium') {
                    $badgeClass = 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30';
                    $catLabel = $isEn ? 'Laboratory' : 'Laboratorium';
                }

                $galleryItems[] = [
                    'id'            => (int) $g['id'],
                    'title'         => ($isEn && !empty($g['title_en'])) ? $g['title_en'] : $g['title'],
                    'category'      => $category,
                    'categoryLabel' => $catLabel,
                    'badgeClass'    => $badgeClass,
                    'image'         => base_url($g['image']),
                    'date'          => ($isEn && !empty($g['date_text_en'])) ? $g['date_text_en'] : $g['date_text'],
                    'location'      => ($isEn && !empty($g['location_en'])) ? $g['location_en'] : $g['location'],
                    'vessel'        => ($isEn && !empty($g['vessel_en'])) ? $g['vessel_en'] : ($g['vessel'] ?? ''),
                    'focal'         => ($isEn && !empty($g['focal_en'])) ? $g['focal_en'] : ($g['focal'] ?? ''),
                    'desc'          => ($isEn && !empty($g['desc_en'])) ? $g['desc_en'] : $g['desc'],
                ];
            }
        } else {
            $galleryItems = [
                [
                    'id'            => 1,
                    'title'         => $isEn ? 'North Natuna Oceanographic Expedition' : 'Ekspedisi Oseanografi Natuna Utara',
                    'category'      => 'ekspedisi',
                    'categoryLabel' => $isEn ? 'Sea Expedition' : 'Ekspedisi Laut',
                    'badgeClass'    => 'bg-gold-500/20 text-gold-400 border-gold-500/30',
                    'image'         => base_url('images/hero_ship.jpg'),
                    'date'          => '12 - 25 November 2025',
                    'location'      => $isEn ? 'North Natuna Sea (Indonesian EEZ Waters)' : 'Laut Natuna Utara (Wilayah ZEE Indonesia)',
                    'vessel'        => $isEn ? 'Collaborative Research Vessel UMRAH - BRIN' : 'Kapal Riset Kolaboratif UMRAH - BRIN',
                    'focal'         => $isEn ? 'Thermocline Structure & Deep Layer Current Dynamics' : 'Karakteristik Termoklin & Dinamika Arus Lapisan',
                    'desc'          => $isEn ? 'Deep-sea research cruise measuring temperature, salinity, and acoustic transmission layers using Acoustic Doppler Current Profiler (ADCP) and CTD rosette sensors down to 150 meters depth.' : 'Pelayaran riset laut dalam untuk mengukur profil suhu, salinitas, dan transmisi akustik bawah air lapis demi lapis menggunakan sensor Acoustic Doppler Current Profiler (ADCP) dan CTD rosette hingga kedalaman 150 meter.',
                ],
                [
                    'id'            => 2,
                    'title'         => $isEn ? 'Bathymetric Survey & Underwater Acoustics' : 'Survei Batimetri & Akustik Bawah Air',
                    'category'      => 'ekspedisi',
                    'categoryLabel' => $isEn ? 'Sea Expedition' : 'Ekspedisi Laut',
                    'badgeClass'    => 'bg-gold-500/20 text-gold-400 border-gold-500/30',
                    'image'         => base_url('images/batimetri_survey.jpg'),
                    'date'          => '14 - 22 Januari 2026',
                    'location'      => $isEn ? 'Helen Mars Reef Navigation Channel, Malacca Strait' : 'Alur Pelayaran Karang Helen Mars, Selat Malaka',
                    'vessel'        => $isEn ? 'RV Baruna Jaya IV & UMRAH Hydrography Team' : 'KM. Baruna Jaya IV & Tim Hidrografi UMRAH',
                    'focal'         => $isEn ? 'Underwater Navigation Hazard Charting (IHO S-44)' : 'Pemetaan Hazard Bawah Air Standar IHO S-44',
                    'desc'          => $isEn ? 'High-resolution bathymetric sounding using Multibeam Echosounder (MBES) and maritime RTK-DGPS to validate safe draft depths for commercial supertankers navigating the Malacca Strait.' : 'Pemeruman kedalaman laut resolusi tinggi menggunakan Multibeam Echosounder (MBES) dan RTK-DGPS maritim untuk memvalidasi batas aman kedalaman draft kapal tanker komersial internasional yang melintasi Selat Malaka.',
                ],
                [
                    'id'            => 3,
                    'title'         => $isEn ? 'Mangrove Ecology & Blue Carbon Bintan' : 'Ekologi Mangrove & Blue Carbon Bintan',
                    'category'      => 'blue-carbon',
                    'categoryLabel' => 'Blue Carbon',
                    'badgeClass'    => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                    'image'         => base_url('images/mangrove_research.jpg'),
                    'date'          => '03 - 10 Februari 2026',
                    'location'      => $isEn ? 'Sebong Pereh Mangrove Forest Area, Bintan' : 'Kawasan Hutan Mangrove Sebong Pereh, Bintan',
                    'vessel'        => $isEn ? 'Mini Catamaran Coastal Ecology Division' : 'Wahana Katamaran Mini Divisi Ekologi Pesisir',
                    'focal'         => $isEn ? 'Sediment Coring & Blue Carbon Stock Valuation' : 'Sediment Coring & Valuasi Stok Karbon Biru',
                    'desc'          => $isEn ? 'Mangrove sediment coring down to 1-meter depth and greenhouse gas flux measurement to calculate coastal blue carbon reserves for local community conservation incentives.' : 'Pengambilan sampel inti sedimen (sediment coring) tanah mangrove hingga kedalaman 1 meter dan pengukuran fluks gas rumah kaca guna menghitung cadangan karbon biru untuk skema insentif konservasi masyarakat adat.',
                ],
                [
                    'id'            => 4,
                    'title'         => $isEn ? 'Oceanography & Marine Instrumentation Laboratory' : 'Laboratorium Oseanografi & Instrumentasi Kelautan',
                    'category'      => 'laboratorium',
                    'categoryLabel' => $isEn ? 'Laboratory' : 'Laboratorium',
                    'badgeClass'    => 'bg-maritime-500/20 text-maritime-300 border-maritime-500/30',
                    'image'         => base_url('images/lab_oseanografi.jpg'),
                    'date'          => 'Operasional Rutin 2026',
                    'location'      => $isEn ? 'Marine Laboratory Building, Dompak Campus' : 'Gedung Laboratorium Kelautan Kampus Dompak',
                    'vessel'        => $isEn ? 'LPPM Oceanographic Calibration Facility' : 'Fasilitas Kalibrasi Instrumen Oseanografi LPPM',
                    'focal'         => $isEn ? 'CTD Calibration, Salinity Benchmarking & Spectrophotometry' : 'Kalibrasi CTD, Uji Salinitas & Spektrofotometri Nutrien',
                    'desc'          => $isEn ? 'Integrated laboratory facility testing physical and chemical oceanography parameters conforming to ISO/IEC 17025 standards.' : 'Fasilitas laboratorium terpadu untuk pengujian parameter fisika dan kimia oseanografi sesuai standar pengujian nasional ISO/IEC 17025.',
                ],
            ];
        }

        // Counter Statistik Capaian Riset (Dynamic from DB with bilingual fallback)
        $stats = [];
        try {
            $statistikModel = new \App\Models\CapaianStatistikModel();
            $hasTableRecords = ($statistikModel->countAllResults() > 0);

            if ($hasTableRecords) {
                $dbStats = $statistikModel->getActiveStats();
                if (!empty($dbStats)) {
                    foreach ($dbStats as $s) {
                        $stats[] = [
                            'number' => $s['number'],
                            'label'  => ($isEn && !empty($s['label_en'])) ? $s['label_en'] : $s['label'],
                            'icon'   => $s['icon'],
                        ];
                    }
                }
            } else {
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
            }
        } catch (\Throwable $e) {
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
        }

        // Sambutan Pimpinan / Koordinator (Dynamic from DB with fallback)
        $sambutan = null;
        try {
            $sambutanModel = new \App\Models\SambutanPimpinanModel();
            $leader = $sambutanModel->first();
            if ($leader) {
                $sambutan = [
                    'name'       => $leader['name'],
                    'title'      => ($isEn && !empty($leader['title_en'])) ? $leader['title_en'] : $leader['title'],
                    'heading'    => ($isEn && !empty($leader['heading_en'])) ? $leader['heading_en'] : (!empty($leader['heading']) ? $leader['heading'] : lang('App.profile_lead_heading')),
                    'quote'      => ($isEn && !empty($leader['quote_en'])) ? $leader['quote_en'] : $leader['quote'],
                    'content'    => ($isEn && !empty($leader['content_en'])) ? $leader['content_en'] : $leader['content'],
                    'image'      => !empty($leader['image']) ? $leader['image'] : 'images/kepala_pusat.jpg',
                    'is_active'  => (bool) ($leader['is_active'] ?? true),
                ];
            }
        } catch (\Throwable $e) {
            $sambutan = null;
        }

        if ($sambutan === null) {
            $sambutan = [
                'name'       => 'Dr. Atika Thahira, S.H., M.H.',
                'title'      => $isEn ? 'Center Coordinator of North Natuna Sea Research Center UMRAH' : 'Koordinator Pusat Studi Laut Natuna Utara UMRAH',
                'heading'    => lang('App.profile_lead_heading'),
                'quote'      => lang('App.profile_lead_quote'),
                'content'    => lang('App.profile_lead_p'),
                'image'      => 'images/kepala_pusat.jpg',
                'is_active'  => true,
            ];
        }

        $data = [
            'title'         => $isEn ? 'Home - North Natuna Sea Research Center UMRAH' : 'Beranda - Pusat Studi Laut Natuna Utara UMRAH',
            'banners'       => $banners,
            'clusters'      => $clusters,
            'stats'         => $stats,
            'sambutan'      => $sambutan,
            'latest_news'   => $latestNews,
            'partners'      => $partners,
            'gallery_items' => $galleryItems,
        ];

        return view('pages/home', $data);
    }
}
