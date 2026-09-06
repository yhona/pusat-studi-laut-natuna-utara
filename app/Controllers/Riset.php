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
        $clustersList = $this->klasterModel->findAll();
        // Convert to keyed array by slug for easy lookup/views
        $clusters = [];
        foreach ($clustersList as $c) {
            $clusters[$c['slug']] = $c;
        }

        $data = [
            'title'        => 'Klaster & Roadmap Riset Kemaritiman - UMRAH',
            'clusters'     => $clusters,
            'clustersList' => $clustersList,
            'roadmap'  => [
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
            ]
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
        $aliases = [
            'sosial-budaya'            => 'hukum-laut',
            'hukum-laut-internasional' => 'hukum-laut',
            'oseanografi'              => 'hukum-laut',
            'oseanografi-iklim'        => 'hukum-laut',
            'logistik-konektivitas'    => 'logistik',
            'energi-terbarukan'        => 'energi',
        ];

        if (isset($aliases[$slug])) {
            $slug = $aliases[$slug];
        }

        $cluster = $this->klasterModel->where('slug', $slug)->first();

        if (! $cluster) {
            throw PageNotFoundException::forPageNotFound('Klaster riset tidak ditemukan: ' . esc($slug));
        }

        // Retrieve other clusters for cross-navigation
        $allClusters = $this->klasterModel->findAll();
        $otherClusters = array_values(array_filter($allClusters, static fn($c) => $c['slug'] !== $slug));

        $data = [
            'title'         => $cluster['title'] . ' - Klaster Riset PSK UMRAH',
            'cluster'       => $cluster,
            'otherClusters' => $otherClusters,
        ];

        return view('pages/riset_detail', $data);
    }
}
