<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBannersMitraGaleriTables extends Migration
{
    public function up()
    {
        // 1. Tabel Hero Banners & Slider Beranda
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'badge' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'badge_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'title_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'desc' => [
                'type' => 'TEXT',
            ],
            'desc_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'link_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'tag' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'tag_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'order_seq' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('hero_banners', true);

        // 2. Tabel Mitra Kerjasama Strategis
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'short_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'pemerintah', // pemerintah, universitas, lembaga_riset, industri
            ],
            'logo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'website_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'order_seq' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mitra_kerjasama', true);

        // 3. Tabel Galeri Riset & Ekspedisi
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'title_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'ekspedisi', // ekspedisi, laboratorium, blue-carbon
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'date_text' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'date_text_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'location_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'vessel' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'vessel_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'focal' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'focal_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'desc' => [
                'type' => 'TEXT',
            ],
            'desc_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'order_seq' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('galeri_riset', true);

        // SEEDING INITIAL DATA
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // Seed Hero Banners
        $db->table('hero_banners')->insertBatch([
            [
                'badge'      => 'Fokus Strategis Perbatasan NKRI',
                'badge_en'   => 'Strategic Border Focus of Indonesia',
                'title'      => 'Kedaulatan Maritim & Eksplorasi Oseanografi Laut Natuna Utara di Pusaran Laut Cina Selatan',
                'title_en'   => 'Maritime Sovereignty & Oceanographic Exploration of North Natuna Sea in South China Sea Dynamics',
                'desc'       => 'Pusat keunggulan sains terdepan dalam kajian hukum laut internasional (UNCLOS 1982), pemantauan hidrodinamika ZEE terluar, serta ketahanan maritim gugus kepulauan terdepan Natuna-Anambas.',
                'desc_en'    => 'A premier center of scientific excellence in international ocean law (UNCLOS 1982), outermost EEZ hydrodynamics monitoring, and archipelagic resilience across the Natuna-Anambas border islands.',
                'link_url'   => 'riset/hukum-laut',
                'tag'        => 'Natuna & LCS 2026',
                'tag_en'     => 'Natuna & LCS 2026',
                'image'      => 'images/hero_ship.jpg',
                'order_seq'  => 1,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'badge'      => 'Kebijakan Strategis Geopolitik',
                'badge_en'   => 'Geopolitical Policy Strategy',
                'title'      => 'Policy Brief: Penguatan Kedaulatan & Tata Kelola ZEE Laut Natuna Utara Terhadap Dinamika Laut Cina Selatan',
                'title_en'   => 'Policy Brief: Strengthening Sovereignty & EEZ Governance of the North Natuna Sea amid South China Sea Dynamics',
                'desc'       => 'Rekomendasi strategis pengawasan ruang laut terpadu, batas landas kontinen, dan perlindungan armada perikanan nasional di perairan terluar Indonesia.',
                'desc_en'    => 'Strategic recommendations for integrated marine spatial surveillance, continental shelf boundaries, and protection of national fishing fleets in outermost Indonesian waters.',
                'link_url'   => 'publikasi#policy-brief',
                'tag'        => 'Policy Brief Khusus',
                'tag_en'     => 'Special Policy Brief',
                'image'      => 'images/batimetri_survey.jpg',
                'order_seq'  => 2,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'badge'      => 'Konferensi Internasional',
                'badge_en'   => 'International Conference',
                'title'      => 'The 4th International Conference on South China Sea Dynamics, Malacca Strait & Archipelago Security',
                'title_en'   => 'The 4th International Conference on South China Sea Dynamics, Malacca Strait & Archipelago Security',
                'desc'       => 'Mengundang periset oseanografi, pakar hukum laut dunia, dan pembuat kebijakan maritim mendiskusikan stabilitas perairan kawasan.',
                'desc_en'    => 'Inviting oceanography researchers, world law of the sea experts, and maritime policymakers to discuss regional water stability.',
                'link_url'   => 'berita',
                'tag'        => 'Konferensi Global',
                'tag_en'     => 'Global Conference',
                'image'      => 'images/mangrove_research.jpg',
                'order_seq'  => 3,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // Seed Mitra Kerjasama
        $db->table('mitra_kerjasama')->insertBatch([
            [
                'name'        => 'Badan Riset dan Inovasi Nasional',
                'short_name'  => 'BRIN',
                'category'    => 'lembaga_riset',
                'logo'        => 'images/partners/logo_brin.svg',
                'website_url' => 'https://brin.go.id',
                'order_seq'   => 1,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Badan Keamanan Laut Republik Indonesia',
                'short_name'  => 'BAKAMLA RI',
                'category'    => 'pemerintah',
                'logo'        => 'images/partners/logo_bakamla.svg',
                'website_url' => 'https://bakamla.go.id',
                'order_seq'   => 2,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Kementerian Kelautan dan Perikanan',
                'short_name'  => 'KKP RI',
                'category'    => 'pemerintah',
                'logo'        => 'images/partners/logo_kkp.svg',
                'website_url' => 'https://kkp.go.id',
                'order_seq'   => 3,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Pemerintah Provinsi Kepulauan Riau',
                'short_name'  => 'Pemprov Kepri',
                'category'    => 'pemerintah',
                'logo'        => 'images/partners/logo_kepri.svg',
                'website_url' => 'https://kepriprov.go.id',
                'order_seq'   => 4,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Pusat Hidro-Oseanografi TNI AL',
                'short_name'  => 'Pushidrosal',
                'category'    => 'pemerintah',
                'logo'        => 'images/partners/logo_pushidrosal.svg',
                'website_url' => 'https://pushidrosal.id',
                'order_seq'   => 5,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Universiti Malaysia Terengganu',
                'short_name'  => 'UMT Malaysia',
                'category'    => 'universitas',
                'logo'        => 'images/partners/logo_umt.svg',
                'website_url' => 'https://umt.edu.my',
                'order_seq'   => 6,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Kementerian PPN / Bappenas',
                'short_name'  => 'Bappenas RI',
                'category'    => 'pemerintah',
                'logo'        => 'images/partners/logo_bappenas.svg',
                'website_url' => 'https://bappenas.go.id',
                'order_seq'   => 7,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Badan Informasi Geospasial',
                'short_name'  => 'BIG',
                'category'    => 'pemerintah',
                'logo'        => 'images/partners/logo_big.svg',
                'website_url' => 'https://big.go.id',
                'order_seq'   => 8,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ]);

        // Seed Galeri Riset
        $db->table('galeri_riset')->insertBatch([
            [
                'title'        => 'Ekspedisi Oseanografi Natuna Utara',
                'title_en'     => 'North Natuna Oceanographic Expedition',
                'category'     => 'ekspedisi',
                'image'        => 'images/hero_ship.jpg',
                'date_text'    => '12 - 25 November 2025',
                'date_text_en' => '12 - 25 November 2025',
                'location'     => 'Laut Natuna Utara (Wilayah ZEE Indonesia)',
                'location_en'  => 'North Natuna Sea (Indonesian EEZ Waters)',
                'vessel'       => 'Kapal Riset Kolaboratif UMRAH - BRIN',
                'vessel_en'    => 'Collaborative Research Vessel UMRAH - BRIN',
                'focal'        => 'Karakteristik Termoklin & Dinamika Arus Lapisan',
                'focal_en'     => 'Thermocline Structure & Deep Layer Current Dynamics',
                'desc'         => 'Pelayaran riset laut dalam untuk mengukur profil suhu, salinitas, dan transmisi akustik bawah air lapis demi lapis menggunakan sensor Acoustic Doppler Current Profiler (ADCP) dan CTD rosette hingga kedalaman 150 meter.',
                'desc_en'      => 'Deep-sea research cruise measuring temperature, salinity, and acoustic transmission layers using Acoustic Doppler Current Profiler (ADCP) and CTD rosette sensors down to 150 meters depth.',
                'order_seq'    => 1,
                'is_active'    => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Survei Batimetri & Akustik Bawah Air',
                'title_en'     => 'Bathymetric Survey & Underwater Acoustics',
                'category'     => 'ekspedisi',
                'image'        => 'images/batimetri_survey.jpg',
                'date_text'    => '14 - 22 Januari 2026',
                'date_text_en' => '14 - 22 January 2026',
                'location'     => 'Alur Pelayaran Karang Helen Mars, Selat Malaka',
                'location_en'  => 'Helen Mars Reef Navigation Channel, Malacca Strait',
                'vessel'       => 'KM. Baruna Jaya IV & Tim Hidrografi UMRAH',
                'vessel_en'    => 'RV Baruna Jaya IV & UMRAH Hydrography Team',
                'focal'        => 'Pemetaan Hazard Bawah Air Standar IHO S-44',
                'focal_en'     => 'Underwater Navigation Hazard Charting (IHO S-44)',
                'desc'         => 'Pemeruman kedalaman laut resolusi tinggi menggunakan Multibeam Echosounder (MBES) dan RTK-DGPS maritim untuk memvalidasi batas aman kedalaman draft kapal tanker komersial internasional yang melintasi Selat Malaka.',
                'desc_en'      => 'High-resolution bathymetric sounding using Multibeam Echosounder (MBES) and maritime RTK-DGPS to validate safe draft depths for commercial supertankers navigating the Malacca Strait.',
                'order_seq'    => 2,
                'is_active'    => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Ekologi Mangrove & Blue Carbon Bintan',
                'title_en'     => 'Mangrove Ecology & Blue Carbon Bintan',
                'category'     => 'blue-carbon',
                'image'        => 'images/mangrove_research.jpg',
                'date_text'    => '03 - 10 Februari 2026',
                'date_text_en' => '03 - 10 February 2026',
                'location'     => 'Kawasan Hutan Mangrove Sebong Pereh, Bintan',
                'location_en'  => 'Sebong Pereh Mangrove Forest Area, Bintan',
                'vessel'       => 'Wahana Katamaran Mini Divisi Ekologi Pesisir',
                'vessel_en'    => 'Mini Catamaran Coastal Ecology Division',
                'focal'        => 'Sediment Coring & Valuasi Stok Karbon Biru',
                'focal_en'     => 'Sediment Coring & Blue Carbon Stock Valuation',
                'desc'         => 'Pengambilan sampel inti sedimen (sediment coring) tanah mangrove hingga kedalaman 1 meter dan pengukuran fluks gas rumah kaca guna menghitung cadangan karbon biru untuk skema insentif konservasi masyarakat adat.',
                'desc_en'      => 'Mangrove sediment coring down to 1-meter depth and greenhouse gas flux measurement to calculate coastal blue carbon reserves for local community conservation incentives.',
                'order_seq'    => 3,
                'is_active'    => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Laboratorium Oseanografi & Instrumentasi Kelautan',
                'title_en'     => 'Oceanography & Marine Instrumentation Laboratory',
                'category'     => 'laboratorium',
                'image'        => 'images/lab_oseanografi.jpg',
                'date_text'    => 'Operasional Rutin 2026',
                'date_text_en' => 'Routine Operations 2026',
                'location'     => 'Gedung Laboratorium Kelautan Kampus Dompak',
                'location_en'  => 'Marine Laboratory Building, Dompak Campus',
                'vessel'       => 'Fasilitas Kalibrasi Instrumen Oseanografi LPPM',
                'vessel_en'    => 'LPPM Oceanographic Instrument Calibration Facility',
                'focal'        => 'Kalibrasi Sensor CTD, SVP & Sonar Akustik',
                'focal_en'     => 'Sensor Calibration for CTD, SVP & Sonar Acoustics',
                'desc'         => 'Pusat kalibrasi dan pengujian perangkat oseanografi fisik sebelum diterjunkan ke laut lepas. Dilengkapi bak uji sensor hidro-akustik, meja kalibrasi geodetik, serta stasiun servis elektronik perkapalan berstandar ISO 17025.',
                'desc_en'      => 'Calibration and testing center for physical oceanographic instruments prior to offshore deployment, equipped with hydro-acoustic sensor testing tanks and ISO 17025 compliant service stations.',
                'order_seq'    => 4,
                'is_active'    => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Analisis Kualitas Air & Sedimen Pantai',
                'title_en'     => 'Coastal Water Quality & Sediment Analysis',
                'category'     => 'laboratorium',
                'image'        => 'images/kualitas_air_sedimen.jpg',
                'date_text'    => 'Operasional Rutin 2026',
                'date_text_en' => 'Routine Operations 2026',
                'location'     => 'Laboratorium Kimia Terpadu UMRAH, Tanjungpinang',
                'location_en'  => 'UMRAH Integrated Chemistry Laboratory, Tanjungpinang',
                'vessel'       => 'Divisi Instrumentasi Spektrofotometri & Granulometri',
                'vessel_en'    => 'Spectrophotometry & Granulometry Division',
                'focal'        => 'Baku Mutu Air Laut & Logam Berat PP 22/2021',
                'focal_en'     => 'Marine Water Quality & Heavy Metal Parameters',
                'desc'         => 'Pengujian terakreditasi untuk parameter fisika, kimia, dan biologi laut: turbiditas, TSS, klorofil-a, nutrien (nitrat/fosfat), serta fraksionasi ukuran butir sedimen pantai guna keperluan AMDAL proyek pelabuhan dan kawasan industri.',
                'desc_en'      => 'Accredited testing for marine physical, chemical, and biological parameters: turbidity, TSS, chlorophyll-a, nutrients, and coastal sediment grain size fractionation.',
                'order_seq'    => 5,
                'is_active'    => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'title'        => 'Stasiun Pengamatan Pasang Surut & Cuaca Maritim',
                'title_en'     => 'Tidal Observation & Marine Weather Station',
                'category'     => 'laboratorium',
                'image'        => 'images/stasiun_pasut_cuaca.jpg',
                'date_text'    => 'Pemantauan Real-time 24/7',
                'date_text_en' => 'Real-time 24/7 Monitoring',
                'location'     => 'Stasiun Pengamat Pasut Dermaga Dompak, Selat Riau',
                'location_en'  => 'Dompak Pier Tide Station, Riau Strait',
                'vessel'       => 'Stasiun Telemetri AWLR Radar & Automatic Weather Station (AWS)',
                'vessel_en'    => 'AWLR Radar Telemetry & Automatic Weather Station (AWS)',
                'focal'        => 'Harmonik Pasut 18.6 Tahun & Meteorologi Pesisir',
                'focal_en'     => '18.6-Year Tidal Harmonics & Coastal Meteorology',
                'desc'         => 'Stasiun observasi otomatis terintegrasi telemetri seluler/satelit yang merekam fluktuasi pasang surut air laut real-time, kecepatan/arah angin permukaan, tekanan udara, serta radiasi surya maritim untuk referensi datum hidrografi nasional.',
                'desc_en'      => 'Automated observation station recording real-time sea level fluctuations, surface wind speed/direction, barometric pressure, and marine solar radiation for national datum hydrography.',
                'order_seq'    => 6,
                'is_active'    => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('hero_banners', true);
        $this->forge->dropTable('mitra_kerjasama', true);
        $this->forge->dropTable('galeri_riset', true);
    }
}
