<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LayananKonsultasiSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $db->table('layanan_konsultasi')->truncate();

        $layananData = [
            [
                'slug'         => 'batimetri',
                'icon'         => 'fa-water',
                'title'        => 'Jasa Survei Batimetri & Hidro-Oseanografi Kelautan',
                'title_en'     => 'Marine Bathymetric & Hydro-Oceanographic Survey',
                'desc'         => 'Pemetaan batimetri resolusi tinggi untuk alur pelayaran kapal, perencanaan dermaga pelabuhan, pemodelan hidrodinamika arus pasang surut, studi erosi pantai, dan analisis sedimentasi muara perairan Kepulauan Riau & Natuna.',
                'desc_en'      => 'High-resolution bathymetric mapping for navigation channels, port pier planning, tidal current hydrodynamic modeling, coastal erosion studies, and sedimentation analytics in Riau Islands and Natuna waters.',
                'code'         => 'SOP-HYD-01',
                'standards'    => 'Standar Hidrografi Internasional IHO S-44 (Special Order & Order 1a), Pedoman Survei Hidros Pushidrosal TNI AL, dan Standar BIG.',
                'sop_name'     => 'SOP Survei Batimetri Akustik & Pengukuran Hidro-Oseanografi Lapangan',
                'instruments'  => json_encode([
                    'Singlebeam & Multibeam Echo Sounder (MBES) Dual Frequency',
                    'Acoustic Doppler Current Profiler (ADCP) 600/300 kHz',
                    'Automatic Tide Gauge (AWLR) & Stasiun Pasut Real-time',
                    'Dual-Frequency RTK-DGPS Marine Navigation & GNSS Positioning',
                    'Sound Velocity Profiler (SVP) Sonar Calibration Probe'
                ], JSON_UNESCAPED_UNICODE),
                'deliverables' => json_encode([
                    'Peta Batimetri Digital Berstandar IHO / Pushidrosal (Skala 1:1.000 - 1:10.000)',
                    'Model Hidrodinamika 2D/3D Kecepatan & Arah Arus Pasang Surut',
                    'Laporan Analisis Oseanografi Fisika, Kedalaman Alur & Rekomendasi Navigasi Kapal'
                ], JSON_UNESCAPED_UNICODE),
                'order_num'    => 1,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'slug'         => 'kualitas-air',
                'icon'         => 'fa-flask-vial',
                'title'        => 'Analisis Kualitas Air Laut & Laboratorium Lingkungan Maritim',
                'title_en'     => 'Seawater Quality Analysis & Marine Environmental Laboratory',
                'desc'         => 'Uji laboratorium baku mutu perairan laut, pengukuran parameter oseanografi kimia, fisika, dan biologi guna keperluan rona lingkungan awal AMDAL/UKL-UPL, izin pembuangan air lindi/efluen, dan kajian daya dukung perairan budidaya.',
                'desc_en'      => 'Accredited laboratory testing of seawater environmental standards, physico-chemical-biological oceanographic parameters for baseline EIA/AMDAL studies, effluent discharge permits, and aquaculture carrying capacity.',
                'code'         => 'SOP-ENV-02',
                'standards'    => 'PP RI No. 22/2021 Lampiran VIII (Baku Mutu Air Laut Pelabuhan, Biota Laut & Wisata Bahari) serta Standar Uji Laboratorium SNI / ISO 17025.',
                'sop_name'     => 'SOP Pengambilan Sampel & Pengujian Baku Mutu Parameter Lingkungan Air Laut',
                'instruments'  => json_encode([
                    'CTD (Conductivity, Temperature, Depth) Multiparameter Oceanographic Probe',
                    'Spectrophotometer UV-Vis Kelautan & Analisis Nutrien (Nitrat, Fosfat, Amonia)',
                    'Water Sampler Niskin & Van Dorn Horisontal/Vertikal 5 Liter',
                    'Portable Turbidimeter, DO Meter, Salinometer & pH-Meter Multi-Sensor',
                    'Van Veen Sediment Grab Sampler & Ayakan Granulometri Sedimen Dasar'
                ], JSON_UNESCAPED_UNICODE),
                'deliverables' => json_encode([
                    'Sertifikat Hasil Uji Laboratorium Terverifikasi Parameter Fisika-Kimia Laut',
                    'Laporan Evaluasi Indeks Pencemaran & Baku Mutu Air Laut (PP 22/2021)',
                    'Dokumen Kajian Daya Dukung Lingkungan Perairan untuk Kelayakan AMDAL / UKL-UPL'
                ], JSON_UNESCAPED_UNICODE),
                'order_num'    => 2,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'slug'         => 'pelabuhan',
                'icon'         => 'fa-anchor',
                'title'        => 'Perancangan & Jasa Studi Kelayakan (FS) Kepelabuhanan',
                'title_en'     => 'Port Engineering & Maritime Infrastructure Feasibility Study',
                'desc'         => 'Penyusunan Studi Kelayakan (Feasibility Study) Fasilitas Pelabuhan komprehensif 7 pilar: Kebutuhan & Regulasi, Hukum & Kelembagaan, Analisis Pasar & Hinterland, Teknis Dermaga & Hidro-oseanografi, Finansial & Komersial, AMDAL Lingkungan, serta Mitigasi Risiko Investasi.',
                'desc_en'      => 'Comprehensive 7-Pillar Port Feasibility Study comprising Need & Compliance, Legal & Institutional Studies, Market Demand & Hinterland, Technical Berth & Hydrodynamics, Financial & Commercial Feasibility, Environmental Impact, and Investment Risk Mitigation.',
                'code'         => 'SOP-PRT-03',
                'standards'    => 'Pedoman Studi Kelayakan Pelabuhan Kemenhub RI (KP 432/2017 & UU No. 17/2008), RIPN, serta Standar Internasional PIANC.',
                'sop_name'     => 'SOP Penyusunan Feasibility Study (FS) & Perancangan Teknis Fasilitas Pelabuhan',
                'instruments'  => json_encode([
                    'Toolkit Penilaian Kebutuhan, Kepatuhan Regulasi & Kelembagaan Pelabuhan',
                    'Model Prakiraan Permintaan Pasar Angkutan Barang & Penumpang (Origin-Destination)',
                    'Software Simulasi Hidro-Oseanografi Kolam Labuh & Olah Gerak Kapal (Delft3D / Mike21)',
                    'Matriks Kelayakan Finansial, Struktur Komersial (KPBU/B2B) & Analisis Sensitivitas'
                ], JSON_UNESCAPED_UNICODE),
                'deliverables' => json_encode([
                    'Buku Laporan Induk Feasibility Study (FS) 7 Pilar Pelabuhan Terverifikasi Tim Ahli',
                    'Rekomendasi Teknis Desain Dermaga, Kedalaman Kolam Putar & Alur Pelayaran',
                    'Lembar Kerja Finansial (IRR, NPV, Payback Period) & Strategi Mitigasi Risiko Investasi'
                ], JSON_UNESCAPED_UNICODE),
                'order_num'    => 3,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'slug'         => 'zonasi',
                'icon'         => 'fa-map-location-dot',
                'title'        => 'Pengembangan Tata Ruang Laut & Pulau-Pulau Kecil (RZWP-3-K)',
                'title_en'     => 'Marine Spatial Planning & Small Islands Zoning (RZWP-3-K)',
                'desc'         => 'Konsultasi teknis dan pendampingan penyusunan rencana zonasi wilayah pesisir dan pulau-pulau kecil (RZWP-3-K), dokumen Kesesuaian Pemanfaatan Ruang Laut (PKKPRL), penetapan kawasan konservasi perairan daerah, dan mitigasi konflik spasial kelautan.',
                'desc_en'      => 'Technical consultancy for coastal and small islands spatial planning (RZWP-3-K), Marine Space Suitability (PKKPRL) dossiers, marine protected area delineation, and spatial conflict resolution models.',
                'code'         => 'SOP-MSP-04',
                'standards'    => 'Permen Kelautan dan Perikanan No. 28/2021 tentang Penyelenggaraan Penataan Ruang Laut, UU Cipta Kerja, dan Standar Geospasial BIG.',
                'sop_name'     => 'SOP Penyusunan & Validasi Dokumen Kesesuaian Ruang Laut (PKKPRL)',
                'instruments'  => json_encode([
                    'Perangkat Lunak ArcGIS / QGIS Enterprise & Spatial Database PostgreSQL/PostGIS',
                    'Citra Satelit Multitemporal Resolusi Tinggi (Sentinel-2, PlanetScope, Landsat-9)',
                    'Drone Pemetaan Pesisir (VTOL RGB 42 MP & Multispektral) Garis Pantai',
                    'Platform Analisis Kesesuaian & Matriks Tumpang Tindih Pemanfaatan Ruang Laut'
                ], JSON_UNESCAPED_UNICODE),
                'deliverables' => json_encode([
                    'Album Peta Tematik Rencana Tata Ruang Laut Skala 1:25.000 / 1:50.000 Berstandar BIG',
                    'Naskah Akademis Kesesuaian Pemanfaatan Ruang Laut (PKKPRL)',
                    'Matriks Indikasi Program Zonasi Berkelanjutan & Kajian Lingkungan Hidup Strategis (KLHS)'
                ], JSON_UNESCAPED_UNICODE),
                'order_num'    => 4,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'slug'         => 'pemberdayaan',
                'icon'         => 'fa-users-gear',
                'title'        => 'Pemberdayaan Masyarakat Pesisir Perbatasan & Valuasi Bahari',
                'title_en'     => 'Coastal Community Empowerment & Maritime Resource Valuation',
                'desc'         => 'Pendampingan sosial-ekonomi nelayan perbatasan terluar Natuna-Anambas, pemetaan rantai pasok komoditas perikanan unggulan, valuasi ekonomi sumber daya hayati laut, serta inkubasi kelembagaan koperasi nelayan pesisir.',
                'desc_en'      => 'Socio-economic mentoring for border fishing communities in Natuna-Anambas, marine commodity supply chain mapping, economic valuation of living marine resources, and coastal cooperative institutional incubation.',
                'code'         => 'SOP-COM-05',
                'standards'    => 'Pedoman Pemberdayaan Masyarakat Pesisir KKP RI, Standar Perencanaan Wilayah Perbatasan Bappenas & Kemendes PDTT.',
                'sop_name'     => 'SOP Kajian Potensi Wilayah Maritim & Pendampingan Nelayan Perbatasan',
                'instruments'  => json_encode([
                    'Kit Lapangan Participatory Rural Appraisal (PRA/RRA) & Rapid Social Assessment',
                    'Geodatabase Sosial-Spasial Sebaran Fishing Ground & Wilayah Tangkap Adat Nelayan',
                    'Toolkit Valuasi Ekonomi Sumber Daya Hayati (Travel Cost Method, CVM & Market Price Proxy)',
                    'Modul Standardisasi Tata Kelola Koperasi Nelayan & Hilirisasi Produk Perikanan'
                ], JSON_UNESCAPED_UNICODE),
                'deliverables' => json_encode([
                    'Laporan Pemetaan Potensi Ekonomi Maritim Wilayah Perbatasan Terluar',
                    'Dokumen Rencana Aksi (Action Plan) Pemberdayaan Komunitas Nelayan Berkelanjutan',
                    'Policy Brief Rekomendasi Kebijakan Kesejahteraan Nelayan untuk Pemerintah Pusat & Daerah'
                ], JSON_UNESCAPED_UNICODE),
                'order_num'    => 5,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'slug'         => 'pelatihan-gis',
                'icon'         => 'fa-chalkboard-user',
                'title'        => 'Pelatihan Teknis & Sertifikasi Geospasial Kemaritiman',
                'title_en'     => 'Maritime Geospatial Training & Professional Certification',
                'desc'         => 'Program pelatihan intensif dan sertifikasi kompetensi GIS kelautan, penginderaan jauh satelit oseanografi, serta pemetaan hidrografi bagi instansi pemerintah (Dinas Kelautan/Bappeda), konsultan, industri maritim, dan akademisi.',
                'desc_en'      => 'Intensive training and competency certification in marine GIS, oceanographic satellite remote sensing, and hydrographic mapping for government agencies, environmental consultants, maritime industries, and researchers.',
                'code'         => 'SOP-TRN-06',
                'standards'    => 'Standar Kompetensi Kerja Nasional Indonesia (SKKNI) Bidang Informasi Geospasial & Standar Akreditasi LPPM UMRAH.',
                'sop_name'     => 'SOP Penyelenggaraan Pelatihan Teknis & Uji Kompetensi Geospasial Kelautan',
                'instruments'  => json_encode([
                    'Fasilitas Laboratorium Komputasi GIS & Pemodelan Numerik Kampus Dompak UMRAH',
                    'Modul Praktikum Berbasis Software Industri (ArcGIS Pro, QGIS, SNAP Sentinel Toolboxes)',
                    'Kumpulan Dataset Spasial Riil Kepulauan Riau, Selat Malaka, dan Laut Natuna Utara',
                    'Instruktur Ahli Geospasial Laut Bersertifikat IHO Cat-A & Asosiasi Surveyor Kelautan'
                ], JSON_UNESCAPED_UNICODE),
                'deliverables' => json_encode([
                    'Sertifikat Pelatihan Resmi LPPM UMRAH dengan Jam Pelajaran Terakreditasi',
                    'Portofolio Hasil Proyek Analisis Spasial & Pemodelan Laut Setiap Peserta',
                    'Akses Repositori Modul Pelatihan Digital, Script Geoprocessing & Konsultasi Lanjutan'
                ], JSON_UNESCAPED_UNICODE),
                'order_num'    => 6,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]
        ];

        $db->table('layanan_konsultasi')->insertBatch($layananData);
    }
}
