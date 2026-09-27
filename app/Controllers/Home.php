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
                if (!empty($c['title_en'])) {
                    $title = $c['title_en'];
                } elseif ($c['slug'] === 'hukum-laut') {
                    $title = lang('App.cluster_1_title');
                } elseif ($c['slug'] === 'logistik') {
                    $title = lang('App.cluster_2_title');
                } elseif ($c['slug'] === 'ketahanan-digital') {
                    $title = lang('App.cluster_3_title');
                } elseif ($c['slug'] === 'energi') {
                    $title = lang('App.cluster_4_title');
                }

                if (!empty($c['mandate_en'])) {
                    $desc = mb_strimwidth($c['mandate_en'], 0, 160, '...');
                } elseif ($c['slug'] === 'hukum-laut') {
                    $desc = lang('App.cluster_1_desc');
                } elseif ($c['slug'] === 'logistik') {
                    $desc = lang('App.cluster_2_desc');
                } elseif ($c['slug'] === 'ketahanan-digital') {
                    $desc = lang('App.cluster_3_desc');
                } elseif ($c['slug'] === 'energi') {
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
        }

        // Counter Statistik Capaian Riset (Dynamic from DB)
        $stats = [];
        try {
            $statistikModel = new \App\Models\CapaianStatistikModel();
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
        } catch (\Throwable $e) {
            $stats = [];
        }

        // Sambutan Pimpinan / Koordinator (Dynamic from DB)
        $sambutan = null;
        try {
            $sambutanModel = new \App\Models\SambutanPimpinanModel();
            $leader = $sambutanModel->where('is_active', 1)->first();
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
