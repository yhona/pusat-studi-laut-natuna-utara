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
                if ($c['slug'] === 'hukum-laut') {
                    $title = lang('App.cluster_1_title');
                    $mandate = lang('App.cluster_1_desc');
                } elseif ($c['slug'] === 'logistik') {
                    $title = lang('App.cluster_2_title');
                    $mandate = lang('App.cluster_2_desc');
                } elseif ($c['slug'] === 'ketahanan-digital') {
                    $title = lang('App.cluster_3_title');
                    $mandate = lang('App.cluster_3_desc');
                } elseif ($c['slug'] === 'energi') {
                    $title = lang('App.cluster_4_title');
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

        $roadmap = $isEn ? [
            [
                'phase' => '2025 - 2026',
                'title' => 'Phase 1: Oceanographic Baseline Data Consolidation & Resource Mapping',
                'desc'  => 'Detailed bathymetric mapping of Riau Strait and Natuna Sea, establishing mangrove blue carbon databases, and inventorying Malay customary maritime law.',
                'status'=> 'In Progress'
            ],
            [
                'phase' => '2027 - 2028',
                'title' => 'Phase 2: Applied Research Commercialization & Marine Energy Innovation',
                'desc'  => 'Pilot testing ocean current turbine prototypes for remote islands, formulating local microalgae-based feeds, and modeling sea-tollway supply chains.',
                'status'=> 'Strategic Plan'
            ],
            [
                'phase' => '2029 - 2030',
                'title' => 'Phase 3: Southeast Asian International Maritime Research Epicenter',
                'desc'  => 'Global research consortium for Malacca Strait - North Natuna Sea, tropical satellite oceanography hub, and policy advisory for international ocean law.',
                'status'=> 'Long-Term Vision'
            ],
        ] : [
            [
                'phase' => '2025 - 2026',
                'title' => 'Fase 1: Konsolidasi Baseline Data Oseanografi & Pemetaan Potensi',
                'desc'  => 'Pemetaan batimetri detail Selat Riau dan Natuna, pembentukan basis data blue carbon mangrove, dan inventarisasi hukum adat laut Melayu.',
                'status'=> 'Sedang Berjalan'
            ],
            [
                'phase' => '2027 - 2028',
                'title' => 'Fase 2: Hilirisasi Riset Terapan & Inovasi Energi Kelautan',
                'desc'  => 'Uji coba prototipe turbin arus laut untuk pulau terpencil, formulasi pakan ikan berbasis mikroalga lokal, serta pemodelan rantai pasok tol laut.',
                'status'=> 'Rencana Strategis'
            ],
            [
                'phase' => '2029 - 2030',
                'title' => 'Fase 3: Episentrum Riset Kemaritiman Internasional Asia Tenggara',
                'desc'  => 'Kemitraan riset global Selat Malaka - Laut Natuna Utara, pusat data satelit oseanografi tropis, dan rujukan kebijakan hukum laut internasional.',
                'status'=> 'Rencana Jangka Panjang'
            ],
        ];

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
            if ($cluster['slug'] === 'hukum-laut') {
                $cluster['title'] = lang('App.cluster_1_title');
                $cluster['short_title'] = 'Maritime Law & Oceanography';
                $cluster['mandate'] = lang('App.cluster_1_desc');
            } elseif ($cluster['slug'] === 'logistik') {
                $cluster['title'] = lang('App.cluster_2_title');
                $cluster['short_title'] = 'Connectivity & Logistics';
                $cluster['mandate'] = lang('App.cluster_2_desc');
            } elseif ($cluster['slug'] === 'ketahanan-digital') {
                $cluster['title'] = lang('App.cluster_3_title');
                $cluster['short_title'] = 'Island Digital Resilience';
                $cluster['mandate'] = lang('App.cluster_3_desc');
            } elseif ($cluster['slug'] === 'energi') {
                $cluster['title'] = lang('App.cluster_4_title');
                $cluster['short_title'] = 'Renewable Marine Energy';
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

        $data = [
            'title'         => ($cluster['title'] ?? 'Klaster Riset') . ($isEn ? ' - NNSRC UMRAH' : ' - Klaster Riset PSK UMRAH'),
            'cluster'       => $cluster,
            'otherClusters' => $otherClusters,
        ];

        return view('pages/riset_detail', $data);
    }
}
