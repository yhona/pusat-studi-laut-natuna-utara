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
                'id'          => 'batimetri',
                'icon'        => 'fa-water',
                'title'       => 'Bathymetric & Hydro-Oceanographic Survey Services',
                'desc'        => 'Detailed bathymetric mapping for navigation channels, port/pier infrastructure engineering, coastal erosion assessments, and harbor sedimentation modeling.',
                'instruments' => ['Singlebeam & Multibeam Echosounders', 'Acoustic Doppler Current Profiler (ADCP)', 'Automated Tide Gauge Stations', 'Marine RTK-DGPS'],
                'deliverables'=> ['Bathymetric Charts (Scale 1:1000 - 1:5000)', 'Tidal Current & Hydrodynamic Models', 'IHO Standardized Oceanographic Survey Report'],
                'spec'        => [
                    'code'        => 'SOP-SRV-01',
                    'standards'   => 'International Hydrographic Organization (IHO S-44 Edition 6.0) & SNI 7646:2010',
                    'sopName'     => 'Standard Operating Procedure for High-Resolution Marine Bathymetric Surveys',
                    'sopSlug'     => 'sop-survei-batimetri',
                    'instruments' => [
                        ['name' => 'Multibeam Echosounder (MBES)', 'param' => 'Operating Frequency 200–400 kHz, depth accuracy ± 0.05 m'],
                        ['name' => 'ADCP Workhorse 300 kHz', 'param' => 'Current profile velocity 0–5 m/s, depth cells up to 100 m'],
                        ['name' => 'RTK-DGPS Marine System', 'param' => 'Horizontal positioning accuracy < 2 cm + 1 ppm'],
                        ['name' => 'SVP Sound Velocity Profiler', 'param' => 'Sound speed resolution 0.001 m/s in seawater column']
                    ],
                    'deliverables' => [
                        'Raw & Processed XYZ / GeoTIFF ASCII Digital Elevation Model',
                        'IHO Compliant Bathymetric Contour Sheet Layout (A0 PDF / GeoPDF)',
                        'Comprehensive Technical Survey Report certified by Certified Hydrographer'
                    ]
                ]
            ],
            [
                'id'          => 'amdal',
                'icon'        => 'fa-flask-vial',
                'title'       => 'Marine Water Quality Testing & Coastal EIA',
                'desc'        => 'Laboratory testing of chemical, biological, and physical oceanographic parameters for environmental permits in shipyard industries, marine ecotourism, and aquaculture.',
                'instruments' => ['CTD (Conductivity, Temperature, Depth)', 'Marine UV-Vis Spectrophotometer', 'Van Dorn & Niskin Water Samplers', 'Multi-parameter Water Quality Probes'],
                'deliverables'=> ['Accredited Laboratory Test Certificates', 'Marine Environmental Carrying Capacity Assessment', 'EIA / Environmental Baseline Assessment Documentation'],
                'spec'        => [
                    'code'        => 'SOP-LAB-03',
                    'standards'   => 'ISO/IEC 17025:2017 & Indonesian Government Regulation PP No. 22 / 2021 Appendix VIII',
                    'sopName'     => 'Standard Operating Procedure for Coastal Seawater Quality Testing & Environmental Baseline',
                    'sopSlug'     => 'sop-uji-kualitas-air',
                    'instruments' => [
                        ['name' => 'CTD Rosette Seabird SBE-19', 'param' => 'Conductivity ± 0.0005 S/m, Temp ± 0.005°C, Depth to 300 m'],
                        ['name' => 'Spectrophotometer UV-Vis Shimadzu', 'param' => 'Wavelength range 190–1100 nm for Nitrates, Phosphates & Chlorophyll-a'],
                        ['name' => 'AAS Heavy Metal Analyzer', 'param' => 'Detection limit Pb, Cd, Hg, Cu down to ppb level (µg/L)'],
                        ['name' => 'Turbidimeter & TSS Gravimetry', 'param' => 'Range 0–1000 NTU and suspended solid balance precision 0.1 mg']
                    ],
                    'deliverables' => [
                        'Accredited Certificate of Analysis (CoA) for Marine Seawater Quality',
                        'Comprehensive Environmental Marine Baseline Report for EIA (AMDAL)',
                        'Heavy Metals & Marine Eutrophication Dispersion Risk Assessment'
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
                'id'          => 'pelatihan',
                'icon'        => 'fa-chalkboard-user',
                'title'       => 'Technical Training & Marine GIS Certification',
                'desc'        => 'Intensive professional training programs for government agencies, environmental consultants, researchers, and maritime university students.',
                'instruments' => ['Dompak Campus GIS Computing Lab', 'ArcGIS & QGIS Modules', 'Real Spatial Data from Malacca Strait & Natuna'],
                'deliverables'=> ['Official UMRAH LPPM Certification', 'Marine Spatial Analysis Map Portfolio', 'Post-Training Advisory with Instructors'],
                'spec'        => [
                    'code'        => 'SOP-TRN-04',
                    'standards'   => 'National Occupational Competency Standard (SKKNI) for Marine GIS Level 6',
                    'sopName'     => 'Standard Operating Procedure for Applied Marine Geospatial Information Systems Training',
                    'sopSlug'     => 'panduan-kerjasama-riset',
                    'instruments' => [
                        ['name' => 'Dompak Marine GIS High-End Lab', 'param' => '30 workstations with Dedicated GPU & Dual Monitors'],
                        ['name' => 'Spatial Processing Software', 'param' => 'ArcGIS Pro, QGIS, SNAP Sentinel Toolbox, Delft3D basics'],
                        ['name' => 'Curriculum Syllabus', 'param' => '40 Hours of blended theory, hydro-acoustic hands-on & field mapping']
                    ],
                    'deliverables' => [
                        'Certified Certificate of Training Completion from LPPM UMRAH',
                        'Digital Portfolio of Marine Thematic Maps (Tidal, Depth, Mangrove Stock)',
                        'Lifetime Access to UMRAH Marine Spatial Training Data Repository'
                    ]
                ]
            ],
            [
                'id'          => 'pelabuhan',
                'icon'        => 'fa-anchor',
                'title'       => 'Port Engineering & Maritime Infrastructure',
                'desc'        => 'Technical design of jetties/piers, vessel berthing facilities, navigation channel maneuvering models, harbor basin sedimentation studies, and maritime structural integrity assessments.',
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
        ] : [
            [
                'id'          => 'batimetri',
                'icon'        => 'fa-water',
                'title'       => 'Jasa Survei Batimetri & Hidro-Oseanografi',
                'desc'        => 'Pemetaan batimetri detail untuk alur pelayaran kapal, perencanaan dermaga/pelabuhan, studi erosi pantai, dan analisis sedimentasi pelabuhan.',
                'instruments' => ['Singlebeam & Multibeam Echosounder', 'Acoustic Doppler Current Profiler (ADCP)', 'Tide Gauge Sensor Otomatis', 'RTK-DGPS Kelautan'],
                'deliverables'=> ['Peta Batimetri Skala 1:1000 - 1:5000', 'Model Hidrodinamika Arus dan Pasang Surut', 'Laporan Analisis Oseanografi Berstandar IHO'],
                'spec'        => [
                    'code'        => 'SOP-SRV-01',
                    'standards'   => 'International Hydrographic Organization (IHO S-44 Edisi 6.0) & SNI 7646:2010',
                    'sopName'     => 'SOP Survei Batimetri Laut Dangkal & Alur Pelayaran Kritis',
                    'sopSlug'     => 'sop-survei-batimetri',
                    'instruments' => [
                        ['name' => 'Multibeam Echosounder (MBES)', 'param' => 'Frekuensi operasi 200–400 kHz, akurasi kedalaman ± 0.05 m'],
                        ['name' => 'ADCP Workhorse 300 kHz', 'param' => 'Rentang kecepatan arus 0–5 m/s, sel pengukuran hingga 100 m'],
                        ['name' => 'RTK-DGPS Kelautan', 'param' => 'Akurasi posisi horizontal < 2 cm + 1 ppm'],
                        ['name' => 'SVP Sound Velocity Profiler', 'param' => 'Koreksi cepat rambat gelombang suara kolom air laut']
                    ],
                    'deliverables' => [
                        'Raw & Processed XYZ / GeoTIFF ASCII Digital Elevation Model',
                        'Peta Lembar Lukis Kedalaman Format Cetak A0 & GeoPDF',
                        'Buku Laporan Teknis Survei Terverifikasi Surveyor Bersertifikasi'
                    ]
                ]
            ],
            [
                'id'          => 'amdal',
                'icon'        => 'fa-flask-vial',
                'title'       => 'Jasa Analisis Kualitas Air Laut & AMDAL Pesisir',
                'desc'        => 'Uji laboratorium parameter oseanografi kimia, biologi, dan fisika guna keperluan izin lingkungan industri perkapalan, pariwisata bahari, dan tambak.',
                'instruments' => ['CTD (Conductivity, Temperature, Depth)', 'Spectrophotometer UV-Vis Kelautan', 'Water Sampler Van Dorn & Niskin', 'DO/Salinity/pH Multi-parameter Probe'],
                'deliverables'=> ['Sertifikat Hasil Uji Laboratorium Terakreditasi', 'Kajian Daya Dukung Lingkungan Perairan', 'Dokumen Rona Lingkungan Awal AMDAL / UKL-UPL'],
                'spec'        => [
                    'code'        => 'SOP-LAB-03',
                    'standards'   => 'ISO/IEC 17025:2017 & Baku Mutu Air Laut PP No. 22 Tahun 2021 Lampiran VIII',
                    'sopName'     => 'SOP Pengujian Kualitas Air Laut & Analisis Logam Berat Pesisir',
                    'sopSlug'     => 'sop-uji-kualitas-air',
                    'instruments' => [
                        ['name' => 'CTD Rosette Seabird SBE-19', 'param' => 'Konduktivitas ± 0.0005 S/m, Suhu ± 0.005°C, Tekanan hingga 300 m'],
                        ['name' => 'Spektrofotometer UV-Vis Shimadzu', 'param' => 'Panjang gelombang 190–1100 nm untuk Nitrat, Fosfat & Klorofil-a'],
                        ['name' => 'AAS Heavy Metal Analyzer', 'param' => 'Batas deteksi Pb, Cd, Hg, Cu hingga satuan ppb (µg/L)'],
                        ['name' => 'Turbidimeter & Neraca Analitik TSS', 'param' => 'Presisi pengukuran padatan tersuspensi hingga 0.1 mg']
                    ],
                    'deliverables' => [
                        'Sertifikat Hasil Uji (Certificate of Analysis) Terakreditasi',
                        'Laporan Deskriptif Status Mutu Air Indeks Pencemaran (IP)',
                        'Rekomendasi Teknis Upaya Pengelolaan Lingkungan Perairan'
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
                'id'          => 'pelatihan',
                'icon'        => 'fa-chalkboard-user',
                'title'       => 'Pelatihan Teknis & Sertifikasi GIS Kelautan',
                'desc'        => 'Program pelatihan intensif bagi instansi pemerintah (Dinas Kelautan/Bappeda), konsultan lingkungan, periset, dan mahasiswa profesional.',
                'instruments' => ['Laboratorium Komputasi GIS Kampus Dompak', 'Modul Berbasis Open Source & ArcGIS', 'Data Spasial Nyata Selat Malaka & Natuna'],
                'deliverables'=> ['Sertifikat Pelatihan Resmi LPPM UMRAH', 'Portofolio Peta Analisis Kelautan', 'Konsultasi Pasca-Pelatihan Bersama Instruktur'],
                'spec'        => [
                    'code'        => 'SOP-TRN-04',
                    'standards'   => 'Standar Kompetensi Kerja Nasional Indonesia (SKKNI) Bidang SIG Kelautan Level 6',
                    'sopName'     => 'SOP Penyelenggaraan Pelatihan & Uji Kompetensi Spasial Kelautan',
                    'sopSlug'     => 'panduan-kerjasama-riset',
                    'instruments' => [
                        ['name' => 'Lab Komputasi Kelautan Dompak', 'param' => '30 unit workstation Dedicated GPU & Dual Monitor'],
                        ['name' => 'Software Pengolahan Spasial', 'param' => 'ArcGIS Pro, QGIS, SNAP Sentinel Toolbox, Delft3D basic'],
                        ['name' => 'Kurikulum Pembelajaran', 'param' => '40 Jam Pelajaran (Teori 30%, Praktik Komputasi 70%)']
                    ],
                    'deliverables' => [
                        'Sertifikat Kelulusan Resmi Terakreditasi LPPM UMRAH',
                        'Portofolio Hasil Karya Peta Tematik Kelautan Peserta',
                        'Akses Repositori Data Spasial Modul Pelatihan Berkelanjutan'
                    ]
                ]
            ],
            [
                'id'          => 'pelabuhan',
                'icon'        => 'fa-anchor',
                'title'       => 'Perancangan & Jasa Kepelabuhanan',
                'desc'        => 'Desain teknis dermaga perintis, fasilitas sandar kapal, pemodelan manuver kapal di alur pelabuhan, studi sedimentasi kolam labuh, dan inspeksi kelayakan struktur maritim.',
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
        ];

        $data = [
            'title'    => $isEn ? 'Services & Laboratories - NNSRC UMRAH' : 'Layanan & Jasa Konsultasi Kemaritiman - UMRAH',
            'services' => $services
        ];

        return view('pages/layanan', $data);
    }
}
