<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStatistikRoadmapSambutanTables extends Migration
{
    public function up()
    {
        // 1. Tabel Capaian Statistik & KPI
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'label_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'fa-chart-line',
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
        $this->forge->createTable('capaian_statistik', true);

        // 2. Tabel Roadmap Riset & Milestone
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'phase' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'Sedang Berjalan',
            ],
            'status_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->createTable('roadmap_riset', true);

        // 3. Tabel Sambutan Pimpinan / Koordinator
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'title_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'heading' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'heading_en' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'quote' => [
                'type' => 'TEXT',
            ],
            'quote_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'content_en' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'default'    => 'images/kepala_pusat.jpg',
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
        $this->forge->createTable('sambutan_pimpinan', true);

        // SEEDING INITIAL DATA
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // 1. Seed Capaian Statistik (matching hardcoded values in Home.php)
        $db->table('capaian_statistik')->insertBatch([
            [
                'number'     => '142+',
                'label'      => 'Publikasi Scopus / SINTA Bereputasi',
                'label_en'   => 'Reputable Scopus / SINTA Publications',
                'icon'       => 'fa-book-open-reader',
                'order_seq'  => 1,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'number'     => '28',
                'label'      => 'Hak Kekayaan Intelektual & Paten Maritim',
                'label_en'   => 'Intellectual Property Rights & Maritime Patents',
                'icon'       => 'fa-certificate',
                'order_seq'  => 2,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'number'     => '35',
                'label'      => 'Mitra Kerjasama Strategis Dalam & Luar Negeri',
                'label_en'   => 'Strategic National & International Partners',
                'icon'       => 'fa-handshake-angle',
                'order_seq'  => 3,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'number'     => '21',
                'label'      => 'Pulau-Pulau Kecil Terluar (PPKT) Binaan di Natuna-Kepri',
                'label_en'   => 'Fostered Outermost Small Islands (PPKT) in Natuna-Kepri',
                'icon'       => 'fa-anchor-circle-check',
                'order_seq'  => 4,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 2. Seed Roadmap Riset 4 Fase (matching hardcoded in Riset.php + 4th phase)
        $db->table('roadmap_riset')->insertBatch([
            [
                'phase'      => '2025 - 2026',
                'title'      => 'Fase 1: Konsolidasi Baseline Data Oseanografi & Pemetaan Potensi',
                'title_en'   => 'Phase 1: Oceanographic Baseline Data Consolidation & Resource Mapping',
                'desc'       => 'Pemetaan batimetri detail Selat Riau dan Natuna, pembentukan basis data blue carbon mangrove, dan inventarisasi hukum adat laut Melayu.',
                'desc_en'    => 'Detailed bathymetric mapping of Riau Strait and Natuna Sea, establishing mangrove blue carbon databases, and inventorying Malay customary maritime law.',
                'status'     => 'Sedang Berjalan',
                'status_en'  => 'In Progress',
                'order_seq'  => 1,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'phase'      => '2027 - 2028',
                'title'      => 'Fase 2: Hilirisasi Riset Terapan & Inovasi Energi Kelautan',
                'title_en'   => 'Phase 2: Applied Research Commercialization & Marine Energy Innovation',
                'desc'       => 'Uji coba prototipe turbin arus laut untuk pulau terpencil, formulasi pakan ikan berbasis mikroalga lokal, serta pemodelan rantai pasok tol laut.',
                'desc_en'    => 'Pilot testing ocean current turbine prototypes for remote islands, formulating local microalgae-based feeds, and modeling sea-tollway supply chains.',
                'status'     => 'Rencana Strategis',
                'status_en'  => 'Strategic Plan',
                'order_seq'  => 2,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'phase'      => '2029 - 2030',
                'title'      => 'Fase 3: Episentrum Riset Kemaritiman Internasional Asia Tenggara',
                'title_en'   => 'Phase 3: Southeast Asian International Maritime Research Epicenter',
                'desc'       => 'Kemitraan riset global Selat Malaka - Laut Natuna Utara, pusat data satelit oseanografi tropis, dan rujukan kebijakan hukum laut internasional.',
                'desc_en'    => 'Global research consortium for Malacca Strait - North Natuna Sea, tropical satellite oceanography hub, and policy advisory for international ocean law.',
                'status'     => 'Rencana Jangka Panjang',
                'status_en'  => 'Long-Term Vision',
                'order_seq'  => 3,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'phase'      => '2031 - 2035',
                'title'      => 'Fase 4: Kemandirian Teknologi & Diplomasi Maritim Global Kawasan Indo-Pasifik',
                'title_en'   => 'Phase 4: Global Maritime Technology Autonomy & Indo-Pacific Diplomatic Leadership',
                'desc'       => 'Penerapan penuh sistem pemantauan otonom perbatasan maritim cerdas berbasis AI/IoT, kemandirian industri energi laut terbarukan kepulauan, dan diplomasi maritim multilateral terdepan.',
                'desc_en'    => 'Full implementation of AI/IoT-driven autonomous border surveillance, complete renewable ocean energy independence for small islands, and foremost multilateral maritime diplomacy.',
                'status'     => 'Visi Jangka Panjang',
                'status_en'  => 'Future Horizon',
                'order_seq'  => 4,
                'is_active'  => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 3. Seed Sambutan Pimpinan (matching home.php text)
        $db->table('sambutan_pimpinan')->insert([
            'name'       => 'Dr. Atika Thahira, S.H., M.H.',
            'title'      => 'Koordinator Pusat Studi Laut Natuna Utara UMRAH',
            'title_en'   => 'Center Coordinator of North Natuna Sea Research Center UMRAH',
            'heading'    => 'Mengokohkan Kedaulatan Bahari Melalui Riset Saintifik & Diplomasi Maritim Laut Natuna Utara',
            'heading_en' => 'Strengthening Maritime Sovereignty Through Scientific Rigor & Ocean Diplomacy in the North Natuna Sea',
            'quote'      => '"Kepulauan Riau dengan gugus kepulauan terluar Natuna-Anambas dan perairan Selat Malaka berhadapan langsung dengan episentrum dinamika geopolitik Laut Cina Selatan. Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH memegang mandat moral dan akademis sebagai garda terdepan sains kebaharian, pemantauan oseanografi ZEE, serta penegakan hukum UNCLOS 1982 demi menjaga kedaulatan laut ibu pertiwi."',
            'quote_en'   => '"Riau Islands with its outermost Natuna-Anambas archipelago and the Malacca Strait faces the epicenter of South China Sea geopolitics. North Natuna Sea Research Center UMRAH carries a moral and scientific mandate to safeguard sovereign waters through oceanographic monitoring and UNCLOS 1982 enforcement."',
            'content'    => 'Sebagai universitas negeri berkarakter kemaritiman di perbatasan utara Indonesia, kami mendedikasikan riset terapan untuk memperkuat data batimetri dasar laut, ketahanan pangan nelayan tradisional di perbatasan, pemodelan arus lintas laut lepas, hingga perlindungan kedaulatan pulau-pulau kecil terluar (PPKT).',
            'content_en' => 'As a public university defined by its maritime character on Indonesia northern border, we dedicate applied research to seafloor bathymetric mapping, traditional border fisheries resilience, cross-sea current modeling, and small island conservation.',
            'image'      => 'images/kepala_pusat.jpg',
            'is_active'  => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('capaian_statistik', true);
        $this->forge->dropTable('roadmap_riset', true);
        $this->forge->dropTable('sambutan_pimpinan', true);
    }
}
