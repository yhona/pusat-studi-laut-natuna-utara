<?php

namespace App\Controllers;

class Layanan extends BaseController
{
    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        $layananModel = new \App\Models\LayananKonsultasiModel();
        $dbServices = $layananModel->where('is_active', 1)->orderBy('order_num', 'ASC')->findAll();

        $services = [];
        if (!empty($dbServices)) {
            foreach ($dbServices as $item) {
                $rawInst = is_array($item['instruments']) ? $item['instruments'] : (json_decode($item['instruments'] ?? '[]', true) ?: []);
                $rawDel  = is_array($item['deliverables']) ? $item['deliverables'] : (json_decode($item['deliverables'] ?? '[]', true) ?: []);

                $specInstruments = [];
                if (is_array($rawInst)) {
                    foreach ($rawInst as $inst) {
                        if (is_array($inst) && isset($inst['name'])) {
                            $specInstruments[] = $inst;
                        } else {
                            $parts = explode(':', (string)$inst, 2);
                            $name = trim($parts[0]);
                            $param = isset($parts[1]) ? trim($parts[1]) : $name;
                            $specInstruments[] = ['name' => $name, 'param' => $param];
                        }
                    }
                }

                $services[] = [
                    'id'          => $item['slug'],
                    'icon'        => $item['icon'] ?? 'fa-anchor',
                    'title'       => ($isEn && !empty($item['title_en'])) ? $item['title_en'] : $item['title'],
                    'desc'        => ($isEn && !empty($item['desc_en'])) ? $item['desc_en'] : $item['desc'],
                    'instruments' => is_array($rawInst) ? $rawInst : [],
                    'deliverables'=> is_array($rawDel) ? $rawDel : [],
                    'spec'        => [
                        'code'        => $item['code'] ?? 'SOP-NNSRC-01',
                        'standards'   => $item['standards'] ?? ($isEn ? 'National & International Maritime Standards' : 'Pedoman & Standar Regulasi Maritim Nasional'),
                        'sopName'     => $item['sop_name'] ?? ($isEn ? 'Standard Operating Procedure' : 'Standar Operasional Prosedur'),
                        'sopSlug'     => 'sop-oseanografi',
                        'instruments' => $specInstruments,
                        'deliverables'=> is_array($rawDel) ? $rawDel : []
                    ]
                ];
            }
        } else {
            $services = $isEn ? [
                [
                    'id'          => 'pelabuhan',
                    'icon'        => 'fa-anchor',
                    'title'       => 'Port Engineering & Maritime Infrastructure',
                    'desc'        => 'Port Feasibility Study comprising Need & Compliance Assessments, Legal & Institutional Studies, Market Demand Analysis, Technical Port Studies, Financial & Commercial Feasibility, Environmental & Social Impact, and Partnership & Risk Governance.',
                    'instruments' => [
                        'Port Need, Regulatory Compliance & Institutional Assessment Toolkit',
                        'Origin-Destination Cargo & Passenger Market Demand Forecasting Models',
                        'Hydro-Oceanographic & Vessel Maneuver Simulation Software (Delft3D / Mike21)',
                        'Financial Feasibility, Commercial Structuring & Risk Analytics Matrix'
                    ],
                    'deliverables'=> [
                        'Comprehensive 7-Pillar Port Feasibility Study (FS) Master Report',
                        'Technical Port Engineering, Basin Hydrodynamics & Berth Layout Blueprint',
                        'Financial Model (IRR, NPV, Sensitivity) & Investment Risk Mitigation Framework'
                    ],
                    'spec'        => [
                        'code'        => 'SOP-PRT-05',
                        'standards'   => 'Ministry of Transportation Port Feasibility Guidelines (KP 432/2017 & Law No. 17/2008) & PIANC Standards',
                        'sopName'     => 'Standard Operating Procedure for Port Feasibility Studies & Technical Maritime Design',
                        'sopSlug'     => 'sop-survei-batimetri',
                        'instruments' => [
                            ['name' => 'Needs, Compliance & Institutional Studies', 'param' => 'Alignment with National Port Masterplan (RIPN), marine spatial zoning (RZWP-3-K), and port authority governance'],
                            ['name' => 'Market Demand & Hinterland Analytics', 'param' => 'Inter-island cargo forecasting, vessel fleet sizing, and logistics competitiveness modeling'],
                            ['name' => 'Technical & Hydrodynamic Assessments', 'param' => 'Delft3D/Mike21 basin calmness, sedimentation, bathymetric draft clearance, and pier structural design'],
                            ['name' => 'Financial, Environmental & Risk Modeling', 'param' => 'CAPEX/OPEX viability, initial EIA/AMDAL criteria, public-private partnership (PPP/B2B) risk matrix']
                        ],
                        'deliverables' => [
                            'Full Verified Port Feasibility Study (FS) Technical & Commercial Dossier',
                            'Technical Engineering Recommendations, Berth Dimensions & Channel Navigation Guidelines',
                            'Financial Sensitivity Spreadsheets & Multi-Risk Mitigation Strategic Plan'
                        ]
                    ]
                ],
                [
                    'id'          => 'pemberdayaan',
                    'icon'        => 'fa-users-gear',
                    'title'       => 'Border Community Empowerment & Maritime Potential Studies',
                    'desc'        => 'Socio-economic assistance for border fishing communities, assessment of prime maritime commodities, local institutional capacity building, and economic downstreaming in small islands.',
                    'instruments' => ['Participatory Rural Appraisal (PRA/RRA) Field Kits', 'Coastal Socio-Spatial GIS Geodatabase', 'Marine Resource Economic Valuation Toolkit', 'Fishermen Cooperative Business Incubation Modules'],
                    'deliverables'=> ['Border & Small Island Maritime Economic Potential Assessment', 'Masterplan for Coastal Community Empowerment & Livelihoods', 'Policy Brief on Border Fishermen Social Welfare & Market Access'],
                    'spec'        => [
                        'code'        => 'SOP-COM-06',
                        'standards'   => 'MMAF Guidelines for Coastal Community Empowerment & Bappenas Frontier Development Standards',
                        'sopName'     => 'Standard Operating Procedure for Border Maritime Potential Studies & Community Outreach',
                        'sopSlug'     => 'panduan-kerjasama-riset',
                        'instruments' => [
                            ['name' => 'Participatory Rural Appraisal (PRA/RRA)', 'param' => 'Community-based coastal assessment & sustainable livelihood mapping'],
                            ['name' => 'Socio-Spatial Coastal GIS', 'param' => 'Integration of traditional fishing ground coordinates and spatial usage'],
                            ['name' => 'Bioresource Economic Valuation Toolkit', 'param' => 'Travel Cost Method (TCM), CVM, and market proxy analysis'],
                            ['name' => 'Coastal Enterprise Institutional Incubation', 'param' => 'Governance standard operating procedures for maritime cooperatives']
                        ],
                        'deliverables' => [
                            'Comprehensive Border Maritime Potential Assessment Report',
                            'Action Plan for Outermost Island Fishing Community Empowerment',
                            'Strategic Policy Brief for Provincial & Central Affirmative Programs'
                        ]
                    ]
                ],
                [
                    'id'          => 'zonasi',
                    'icon'        => 'fa-map-location-dot',
                    'title'       => 'Marine Spatial Planning & Small Islands Development',
                    'desc'        => 'Technical advisory and formulation of coastal zone and small island spatial plans, marine protected area delimitation, and marine spatial conflict resolution.',
                    'instruments' => ['Marine GIS & Spatial Geodatabases', 'High-Resolution Sentinel & Landsat Satellite Imagery', 'Coastal Surveillance Drone Fleet'],
                    'deliverables'=> ['National Geospatial Standard Thematic Maps', 'Academic Policy Papers on Coastal Zoning', 'Spatial Conflict Resolution Models'],
                    'spec'        => [
                        'code'        => 'SOP-MSP-02',
                        'standards'   => 'Ministerial Regulation KKP No. 28/2021 & BIG Geospatial Standards',
                        'sopName'     => 'Standard Operating Procedure for Archipelagic Coastal Zoning (RZWP-3-K) Planning',
                        'sopSlug'     => 'sop-survei-batimetri',
                        'instruments' => [
                            ['name' => 'Enterprise Marine GIS System', 'param' => 'Spatial Geodatabase multi-user PostgreSQL/PostGIS'],
                            ['name' => 'Satellite Multispectral Imagery', 'param' => 'Sentinel-2 & PlanetScope 3m high-resolution imagery'],
                            ['name' => 'VTOL Mapping Drone', 'param' => 'RGB 42 MP & Multispectral sensor for shoreline boundary baseline']
                        ],
                        'deliverables' => [
                            'Official Coastal Spatial Zoning Thematic Map Layers (Shapefile/GeoPackage)',
                            'Academic Manuscript & Regulatory Matrix Draft for Provincial Enactment',
                            'Marine Space Conflict Resolution & Multi-Stakeholder Conciliation Blueprint'
                        ]
                    ]
                ],
            ] : [
                [
                    'id'          => 'pelabuhan',
                    'icon'        => 'fa-anchor',
                    'title'       => 'Perancangan & Jasa Kepelabuhanan',
                    'desc'        => 'Feasibility Study (Studi Kelayakan) Pelabuhan dengan melakukan kajian Kebutuhan dan Kepatuhan, Kajian Hukum dan Kelembagaan, Analisa Permintaan dan Pasar, Kajian Teknis Pelabuhan, Kajian Aspek Keuangan dan Komersial, Kajian Lingkungan dan Sosial serta Kajian Kerjasama dan Resiko.',
                    'instruments' => [
                        'Toolkit Analisis Kebutuhan, Kepatuhan Regulasi & Kelembagaan Pelabuhan',
                        'Pemodelan Permintaan & Pasar Kargo/Penumpang (Origin-Destination)',
                        'Software Simulasi Hidro-Oseanografi & Manuver Kapal (Delft3D / Mike21)',
                        'Instrumen Kelayakan Finansial, Analisis Resiko & Kerjasama (KPBU / B2B)'
                    ],
                    'deliverables'=> [
                        'Laporan Feasibility Study (FS) Komprehensif 7 Pilar Kelayakan Pelabuhan',
                        'Dokumen Analisis Teknis, Hidrodinamika Kolam Labuh & Rekomendasi Layout Dermaga',
                        'Model Proyeksi Finansial (IRR, NPV, Payback) & Matriks Mitigasi Resiko Investasi'
                    ],
                    'spec'        => [
                        'code'        => 'SOP-PRT-05',
                        'standards'   => 'Pedoman Studi Kelayakan Pelabuhan Kemenhub RI (KP 432/2017 & UU No. 17/2008) serta Standar PIANC',
                        'sopName'     => 'SOP Penyusunan Studi Kelayakan (Feasibility Study) & Perancangan Teknis Pelabuhan',
                        'sopSlug'     => 'sop-survei-batimetri',
                        'instruments' => [
                            ['name' => 'Kajian Kebutuhan, Kepatuhan & Kelembagaan', 'param' => 'Evaluasi kepatuhan RIPN, tata ruang wilayah (RZWP-3-K), dan regulasi otoritas maritim'],
                            ['name' => 'Analisa Permintaan, Pasar & Hinterland', 'param' => 'Model proyeksi arus barang, armada kapal feeder, dan daya saing logistik kepulauan'],
                            ['name' => 'Kajian Teknis & Hidro-Oseanografi', 'param' => 'Simulasi Delft3D/Mike21 ketenangan kolam, bathymetry clearance, dan layout dermaga'],
                            ['name' => 'Kelayakan Finansial, Lingkungan & Resiko', 'param' => 'Kalkulasi CAPEX/OPEX, kelayakan komersial, AMDAL awal, dan skema kemitraan investasi']
                        ],
                        'deliverables' => [
                            'Dokumen Utama Feasibility Study (FS) Pelabuhan Lengkap Terverifikasi Ahli',
                            'Buku Rekomendasi Desain Teknis, Dimensi Sandar & Karakteristik Alur Pelayaran',
                            'Matriks Kelayakan Finansial, Analisis Sensitivitas & Rencana Mitigasi Resiko'
                        ]
                    ]
                ],
                [
                    'id'          => 'pemberdayaan',
                    'icon'        => 'fa-users-gear',
                    'title'       => 'Pemberdayaan Masyarakat Perbatasan & Kajian Potensi',
                    'desc'        => 'Pendampingan kapasitas nelayan pesisir perbatasan, kajian valuasi ekonomi sumber daya hayati laut, penguatan kelembagaan lokal masyarakat pulau-pulau kecil, serta strategi hilirisasi produk perikanan.',
                    'instruments' => ['Metodologi Partisipatif PRA (Participatory Rural Appraisal)', 'Sistem Informasi Geografis Sosial-Spasial Pesisir', 'Instrumen Valuasi Ekonomi Sumber Daya Laut', 'Modul Inkubasi Koperasi Nelayan & UMKM Pesisir'],
                    'deliverables'=> ['Laporan Komprehensif Kajian Potensi Ekonomi Maritim Perbatasan', 'Masterplan Pemberdayaan Nelayan & Masyarakat Pulau Kecil', 'Naskah Kebijakan (Policy Brief) Kesejahteraan Sosial Pesisir'],
                    'spec'        => [
                        'code'        => 'SOP-COM-06',
                        'standards'   => 'Pedoman Pemberdayaan Masyarakat Pesisir KKP RI & Standar Perencanaan Wilayah Perbatasan Bappenas',
                        'sopName'     => 'SOP Kajian Potensi Wilayah Maritim & Pendampingan Masyarakat Pesisir Perbatasan',
                        'sopSlug'     => 'panduan-kerjasama-riset',
                        'instruments' => [
                            ['name' => 'Pendekatan Partisipatif PRA/RRA', 'param' => 'Pemetaan sosial desa pesisir terpadu dan asesmen mata pencaharian berkelanjutan'],
                            ['name' => 'Pemetaan Sosial-Spasial Berbasis SIG', 'param' => 'Integrasi sebaran fishing ground nelayan tradisional dan wilayah tangkap adat'],
                            ['name' => 'Valuasi Ekonomi Sumber Daya Hayati', 'param' => 'Travel Cost Method (TCM), Contingent Valuation (CVM), dan Market Price Proxy'],
                            ['name' => 'Inkubasi Kelembagaan Usaha Pesisir', 'param' => 'Standardisasi tata kelola kelompok usaha perikanan dan sertifikasi produk olahan']
                        ],
                        'deliverables' => [
                            'Dokumen Komprehensif Kajian Potensi Ekonomi Maritim Wilayah Perbatasan',
                            'Rencana Aksi (Action Plan) Pemberdayaan Komunitas Nelayan Pulau Terluar',
                            'Policy Brief Rekomendasi Alokasi Program Afirmasi Pemerintah Pusat/Daerah'
                        ]
                    ]
                ],
                [
                    'id'          => 'zonasi',
                    'icon'        => 'fa-map-location-dot',
                    'title'       => 'Pengembangan Tata Ruang Laut & Pulau-Pulau Kecil',
                    'desc'        => 'Konsultasi teknis dan pendampingan penyusunan rencana zonasi wilayah pesisir dan pulau-pulau kecil (RZWP-3-K), penetapan kawasan konservasi perairan, dan analisis spasial pencegahan konflik pemanfaatan ruang laut.',
                    'instruments' => ['Software GIS Kelautan & Geodatabase Spasial', 'Citra Satelit Sentinel & Landsat Resolusi Tinggi', 'Drone Surveillance Wilayah Pesisir'],
                    'deliverables'=> ['Peta Tematik Spasial Berstandar BIG', 'Naskah Akademis Kebijakan Zonasi Kelautan', 'Model Penyelesaian Konflik Ruang Pemanfaatan'],
                    'spec'        => [
                        'code'        => 'SOP-MSP-02',
                        'standards'   => 'Permen Kelautan dan Perikanan No. 28/2021 & Standar Geospasial BIG',
                        'sopName'     => 'SOP Penyusunan Rencana Tata Ruang Laut & Zonasi Pesisir Terpadu',
                        'sopSlug'     => 'sop-survei-batimetri',
                        'instruments' => [
                            ['name' => 'Enterprise Marine GIS System', 'param' => 'Sistem Geodatabase spasial PostgreSQL/PostGIS multi-user'],
                            ['name' => 'Citra Satelit Multitemporal', 'param' => 'Sentinel-2 & PlanetScope resolusi 3 meter untuk pemetaan habitat'],
                            ['name' => 'Drone Mapping VTOL Pesisir', 'param' => 'Sensor RGB 42 MP & Multispektral untuk verifikasi garis pantai']
                        ],
                        'deliverables' => [
                            'Lapisan Data Spasial Tematik Kelautan (Format Shapefile/GeoPackage)',
                            'Dokumen Naskah Akademis Usulan Peraturan Daerah Zonasi',
                            'Peta Matriks Kesesuaian Pemanfaatan Ruang Perairan Laut'
                        ]
                    ]
                ],
            ];
        }

        $data = [
            'title'    => $isEn ? 'Services & Laboratories - NNSRC UMRAH' : 'Layanan & Jasa Konsultasi Kemaritiman - UMRAH',
            'services' => $services
        ];

        return view('pages/layanan', $data);
    }
}
