<?php

namespace App\Controllers;

class Layanan extends BaseController
{
    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        $services = $isEn ? [
            [
                'id'          => 'pelabuhan',
                'icon'        => 'fa-anchor',
                'title'       => 'Port Engineering & Maritime Infrastructure',
                'desc'        => 'Port Feasibility Study comprising Need & Compliance Assessments, Legal & Institutional Studies, Market Demand Analysis, Technical Port Studies, Financial & Commercial Feasibility, Environmental & Social Impact, and Partnership & Risk Governance.',
                'instruments' => ['Delft3D & Mike21 Coastal Hydrodynamic Modeling', 'Sub-Bottom Profiler & Side Scan Sonar', 'Non-Destructive Testing (NDT) for Marine Concrete', 'Real-Time MetOcean Buoy Sensors'],
                'deliverables'=> ['Detail Engineering Design (DED) for Jetties & Ports', 'Technical Feasibility Study (FS) Report', 'Harbor Basin Siltation & Vessel Maneuver Simulation'],
                'spec'        => [
                    'code'        => 'SOP-PRT-05',
                    'standards'   => 'Ministry of Transportation Port Technical Guidelines (KP 432/2017) & PIANC Standards',
                    'sopName'     => 'Standard Operating Procedure for Port Infrastructure Design & Jetty Feasibility Studies',
                    'sopSlug'     => 'sop-survei-batimetri',
                    'instruments' => [
                        ['name' => 'Hydrodynamic & Wave Modeling Suite', 'param' => 'Delft3D Flow/Wave & Mike21 for wave reflection and calm basin analysis'],
                        ['name' => 'Sub-Bottom Profiler (SBP)', 'param' => 'Seafloor strata penetrations up to 30 m for jetty piling assessment'],
                        ['name' => 'Side Scan Sonar High-Res', 'param' => 'Dual frequency 100/400 kHz for seabed obstacle & mooring clearance'],
                        ['name' => 'Rebound Hammer & Ultrasonic NDT', 'param' => 'Concrete strength & maritime rebar corrosion ultrasonic analysis']
                    ],
                    'deliverables' => [
                        'Detail Engineering Design (DED) Architectural & Structural Port Blueprint',
                        'Hydro-Oceanographic Feasibility Study Report for Berth & Pier Placement',
                        'Vessel Berthing Energy & Channel Navigation Safety Risk Assessment'
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
                'instruments' => ['Software Pemodelan Hidrodinamika Pelabuhan (Delft3D/Mike21)', 'Sub-Bottom Profiler & Side Scan Sonar', 'Instrumen NDT Uji Beton & Korosi Dermaga', 'Sensor Telemetri MetOcean Real-Time'],
                'deliverables'=> ['Detail Engineering Design (DED) Dermaga/Pelabuhan Rakyat', 'Laporan Studi Kelayakan Teknis (Feasibility Study)', 'Analisis Dinamika Manuver Olah Gerak Kapal & Sedimentasi'],
                'spec'        => [
                    'code'        => 'SOP-PRT-05',
                    'standards'   => 'Standar Teknis Kepelabuhanan Kemenhub RI (KP 432/2017) & PIANC Guidelines',
                    'sopName'     => 'SOP Perancangan Fasilitas Pelabuhan & Survei Kelayakan Teknis Dermaga',
                    'sopSlug'     => 'sop-survei-batimetri',
                    'instruments' => [
                        ['name' => 'Suite Software Hidrodinamika & Gelombang', 'param' => 'Delft3D Flow/Wave & Mike21 analisis ketenangan kolam pelabuhan'],
                        ['name' => 'Sub-Bottom Profiler (SBP)', 'param' => 'Penetrasi stratigrafi dasar laut hingga 30 m untuk pondasi tiang pancang'],
                        ['name' => 'Side Scan Sonar Frekuensi Ganda', 'param' => '100/400 kHz deteksi rintangan navigasi dasar alur sandar'],
                        ['name' => 'Ultrasonic Pulse Velocity & Schmidt Hammer', 'param' => 'Uji mutu beton struktur dermaga dan mitigasi korosi air laut']
                    ],
                    'deliverables' => [
                        'Buku Gambar Rencana Detail Engineering Design (DED) Struktur Dermaga',
                        'Laporan Kelayakan Hidro-Oseanografi dan Penempatan Sisi Sandar',
                        'Kajian Energi Tumbukan Kapal (Berthing Energy) dan Mitigasi Sedimentasi'
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

        $data = [
            'title'    => $isEn ? 'Services & Laboratories - NNSRC UMRAH' : 'Layanan & Jasa Konsultasi Kemaritiman - UMRAH',
            'services' => $services
        ];

        return view('pages/layanan', $data);
    }
}
