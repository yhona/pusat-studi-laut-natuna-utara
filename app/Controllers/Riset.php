<?php

namespace App\Controllers;

use App\Models\KlasterRisetModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Riset extends BaseController
{
    protected KlasterRisetModel $klasterModel;

    public function __construct()
    {
        $this->klasterModel = new KlasterRisetModel();
    }

    /**
     * Research roadmap and clusters overview.
     */
    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        $dbClusters = $this->klasterModel->findAll();
        $clustersList = [];

        foreach ($dbClusters as $c) {
            $title = $c['short_title'] ?? $c['title'];
            $mandate = $c['mandate'];

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
                    $mandate = $c['mandate_en'];
                } elseif ($c['slug'] === 'hukum-laut') {
                    $mandate = lang('App.cluster_1_desc');
                } elseif ($c['slug'] === 'logistik') {
                    $mandate = lang('App.cluster_2_desc');
                } elseif ($c['slug'] === 'ketahanan-digital') {
                    $mandate = lang('App.cluster_3_desc');
                } elseif ($c['slug'] === 'energi') {
                    $mandate = lang('App.cluster_4_desc');
                }
            }

            $c['title'] = $title;
            $c['mandate'] = $mandate;
            $clustersList[] = $c;
        }

        $clusters = [];
        foreach ($clustersList as $c) {
            $clusters[$c['slug']] = $c;
        }

        $roadmap = [];
        try {
            $roadmapModel = new \App\Models\RoadmapRisetModel();
            $dbRoadmap = $roadmapModel->getActiveRoadmap();
            if (!empty($dbRoadmap)) {
                foreach ($dbRoadmap as $r) {
                    $roadmap[] = [
                        'phase'  => $r['phase'],
                        'title'  => ($isEn && !empty($r['title_en'])) ? $r['title_en'] : $r['title'],
                        'desc'   => ($isEn && !empty($r['desc_en'])) ? $r['desc_en'] : $r['desc'],
                        'status' => ($isEn && !empty($r['status_en'])) ? $r['status_en'] : $r['status'],
                    ];
                }
            }
        } catch (\Throwable $e) {
            $roadmap = [];
        }

        $data = [
            'title'        => $isEn ? 'Research Clusters & Roadmap - NNSRC UMRAH' : 'Klaster & Roadmap Riset Kemaritiman - UMRAH',
            'clusters'     => $clusters,
            'clustersList' => $clustersList,
            'roadmap'      => $roadmap
        ];

        return view('pages/riset', $data);
    }

    /**
     * Display comprehensive cluster detail page.
     *
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function detail(string $slug): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        $aliases = [
            'sosial-budaya'                               => 'hukum-laut',
            'hukum-laut-internasional'                    => 'hukum-laut',
            'hukum-laut'                                  => 'hukum-laut',
            'oseanografi'                                 => 'hukum-laut',
            'oseanografi-iklim'                           => 'hukum-laut',
            'logistik'                                    => 'logistik',
            'logistik-konektivitas'                       => 'logistik',
            'logistik-dan-konektivitas-kepulauan'         => 'logistik',
            'ekonomi-biru-dan-tata-kelola-maritim'        => 'logistik',
            'ketahanan-digital'                           => 'ketahanan-digital',
            'ketahanan-digital-kepulauan'                 => 'ketahanan-digital',
            'energi'                                      => 'energi',
            'energi-terbarukan'                           => 'energi',
            'energi-terbarukan-di-wilayah-kepulauan'      => 'energi',
            'energi-terbarukan-dan-keberlanjutan-pesisir' => 'energi',
        ];

        if (isset($aliases[$slug])) {
            $slug = $aliases[$slug];
        }

        $cluster = $this->klasterModel->where('slug', $slug)->first();

        if (! $cluster) {
            throw PageNotFoundException::forPageNotFound('Klaster riset tidak ditemukan: ' . esc($slug));
        }

        $coordImages = [
            'hukum-laut'        => base_url('images/peneliti_rachma.jpg'),
            'logistik'          => base_url('images/peneliti_ady.jpg'),
            'ketahanan-digital' => base_url('images/peneliti_dedy.jpg'),
        ];
        if (isset($coordImages[$cluster['slug']])) {
            $cluster['coordinator']['image'] = $coordImages[$cluster['slug']];
        }

        if ($isEn) {
            if (!empty($cluster['title_en'])) {
                $cluster['title'] = $cluster['title_en'];
            } elseif ($cluster['slug'] === 'hukum-laut') {
                $cluster['title'] = lang('App.cluster_1_title');
            } elseif ($cluster['slug'] === 'logistik') {
                $cluster['title'] = lang('App.cluster_2_title');
            } elseif ($cluster['slug'] === 'ketahanan-digital') {
                $cluster['title'] = lang('App.cluster_3_title');
            } elseif ($cluster['slug'] === 'energi') {
                $cluster['title'] = lang('App.cluster_4_title');
            }

            if (!empty($cluster['mandate_en'])) {
                $cluster['mandate'] = $cluster['mandate_en'];
            } elseif ($cluster['slug'] === 'hukum-laut') {
                $cluster['mandate'] = lang('App.cluster_1_desc');
            } elseif ($cluster['slug'] === 'logistik') {
                $cluster['mandate'] = lang('App.cluster_2_desc');
            } elseif ($cluster['slug'] === 'ketahanan-digital') {
                $cluster['mandate'] = lang('App.cluster_3_desc');
            } elseif ($cluster['slug'] === 'energi') {
                $cluster['mandate'] = lang('App.cluster_4_desc');
            }
        }

        // Retrieve other clusters for cross-navigation
        $allClusters = $this->klasterModel->findAll();
        $otherClusters = array_values(array_filter($allClusters, static fn($c) => $c['slug'] !== $slug));

        if ($isEn) {
            foreach ($otherClusters as &$oc) {
                if ($oc['slug'] === 'hukum-laut') {
                    $oc['short_title'] = 'Maritime Law & Oceanography';
                    $oc['mandate'] = lang('App.cluster_1_desc');
                } elseif ($oc['slug'] === 'logistik') {
                    $oc['short_title'] = 'Connectivity & Logistics';
                    $oc['mandate'] = lang('App.cluster_2_desc');
                } elseif ($oc['slug'] === 'ketahanan-digital') {
                    $oc['short_title'] = 'Island Digital Resilience';
                    $oc['mandate'] = lang('App.cluster_3_desc');
                } elseif ($oc['slug'] === 'energi') {
                    $oc['short_title'] = 'Renewable Marine Energy';
                    $oc['mandate'] = lang('App.cluster_4_desc');
                }
            }
            unset($oc);
        }

        $clusterDesc = !empty($cluster['mandate']) 
            ? trim(strip_tags((string)$cluster['mandate'])) 
            : ($cluster['title'] ?? 'Klaster Riset Kemaritiman');

        $clusterImage = !empty($cluster['image']) ? $cluster['image'] : 'images/hero_ship.jpg';

        $data = [
            'title'         => ($cluster['title'] ?? 'Klaster Riset') . ($isEn ? ' - NNSRC UMRAH' : ' - Klaster Riset PSK UMRAH'),
            'meta_desc'     => $clusterDesc,
            'og_desc'       => $clusterDesc,
            'og_image'      => $clusterImage,
            'og_type'       => 'article',
            'canonical_url' => base_url('riset/' . $cluster['slug']),
            'cluster'       => $cluster,
            'otherClusters' => $otherClusters,
        ];

        return view('pages/riset_detail', $data);
    }
}
