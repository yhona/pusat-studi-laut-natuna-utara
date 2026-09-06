<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RisetSeeder extends Seeder
{
    public function run()
    {
        $clusters = [
            [
                'slug'        => 'hukum-laut',
                'title'       => 'Hukum Laut Internasional',
                'title_en'    => 'Cluster of International Law of the Sea',
                'short_title' => 'Hukum Laut Internasional',
                'icon'        => 'fa-scale-balanced',
                'badge'       => 'Klaster I',
                'coordinator' => json_encode([
                    'name'      => 'Rachma Indriyani, S.H., LL.M., Ph.D.',
                    'nip'       => '19861118 201212 2 001',
                    'scopus_id' => '57223868958',
                    'email'     => 'rachmaindriyani@staff.uns.ac.id',
                    'role'      => 'Koordinator Klaster & Vice of Research Department',
                ], JSON_UNESCAPED_UNICODE),
                'mandate'     => 'Mengkaji kedaulatan dan hak berdaulat batas maritim NKRI di Laut Natuna Utara berlandaskan UNCLOS 1982, dinamika sengketa kawasan Laut China Selatan, yurisdiksi Alur Laut Kepulauan Indonesia (ALKI) I, serta advokasi perlindungan hak-hak nelayan tradisional lintas batas perairan.',
                'focus_areas' => json_encode([
                    [
                        'title' => 'Kedaulatan & Rezim Batas Maritim UNCLOS 1982 di Laut Natuna Utara',
                        'desc'  => 'Analisis hukum penetapan batas landas kontinen dan ZEE Indonesia di perairan Natuna di tengah dinamika klaim historis dan geopolitik regional.',
                    ],
                    [
                        'title' => 'Yurisdiksi dan Keamanan Alur Laut Kepulauan Indonesia (ALKI) I',
                        'desc'  => 'Kajian hak lintas transit kapal asing, penegakan hukum di koridor pelayaran Selat Malaka - Selat Sunda - Natuna, serta pencegahan kejahatan maritim transnasional.',
                    ],
                    [
                        'title' => 'Advokasi Hak Nelayan Tradisional Lintas Batas (Traditional Fishing Rights)',
                        'desc'  => 'Pendampingan hukum bagi nelayan skala kecil perbatasan Natuna-Anambas dari penangkapan lintas batas dan penegakan hukum terhadap kapal ikan asing (IUU Fishing).',
                    ],
                    [
                        'title' => 'Resolusi Hukum Tata Kelola Ruang Laut & Sengketa Perbatasan',
                        'desc'  => 'Penyusunan naskah akademik mediasi dan rekonsiliasi pemanfaatan ruang laut antara sektor migas lepas pantai, kabel optik, dan hak ulayat nelayan adat.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'flagship_projects' => json_encode([
                    [
                        'title'   => 'Kajian Kedaulatan Pulau-Pulau Kecil Terluar (PPKT) Natuna-Anambas Pasca-Ratifikasi Batas Maritim',
                        'funding' => 'Kemenko Polhukam & UMRAH',
                        'period'  => '2025 - 2026',
                        'desc'    => 'Kajian geostrategis dan instrumen hukum internasional pengelolaan 21 pulau terdepan perbatasan Indonesia-Malaysia-Vietnam.',
                    ],
                    [
                        'title'   => 'Penyusunan Pedoman Hukum Perlindungan Hak Tangkap Nelayan Tradisional di Perbatasan ZEE Natuna',
                        'funding' => 'Kemlu RI & PSK UMRAH',
                        'period'  => '2025',
                        'desc'    => 'Kajian empiris dan yuridis rekomendasi kebijakan diplomasi maritim bilateral Indonesia dengan negara tetangga.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'facilities' => json_encode([
                    'Laboratorium Simulasi Peradilan Semu & Arbitrase Maritim Internasional',
                    'Pusat Dokumentasi Traktat Batas Maritim & Naskah Hukum Laut UNCLOS 1982',
                    'Ruang Khazanah Arsip Peta Perbatasan & Landas Kontinen Natuna',
                    'Studio Konsultasi Hukum Nelayan Tradisional & Advokasi Kebijakan',
                ], JSON_UNESCAPED_UNICODE),
                'publications' => json_encode([
                    [
                        'title'   => 'Sovereignty and Maritime Boundary Delimitation in the North Natuna Sea under UNCLOS 1982: Indonesia\'s Strategic Posture',
                        'journal' => 'Ocean & Coastal Management (Scopus Q1)',
                        'year'    => '2025',
                        'doi'     => '10.1016/j.ocecoaman.2024.107012',
                    ],
                    [
                        'title'   => 'Traditional Fishing Rights of Coastal Malay Communities in the Natuna Border Waters: Legal Gaps and Bilateral Solutions',
                        'journal' => 'Marine Policy (Scopus Q1)',
                        'year'    => '2024',
                        'doi'     => '10.1016/j.marpol.2024.105980',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'created_at'  => '2025-01-01 00:00:00',
                'updated_at'  => '2025-01-01 00:00:00',
            ],
            [
                'slug'        => 'logistik',
                'title'       => 'Logistik dan Konektivitas Kepulauan',
                'title_en'    => 'Cluster of Archipelago Logistics & Port Connectivity',
                'short_title' => 'Logistik & Konektivitas Kepulauan',
                'icon'        => 'fa-ship',
                'badge'       => 'Klaster II',
                'coordinator' => json_encode([
                    'name'      => 'Dr. Ady Muzwardi, S.IP., M.A., M.H.I.',
                    'nip'       => '19810410 200604 1 002',
                    'scopus_id' => '57727069200',
                    'email'     => 'ady.muzwardi@umrah.ac.id',
                    'role'      => 'Koordinator Klaster & Head of Research Department',
                ], JSON_UNESCAPED_UNICODE),
                'mandate'     => 'Menjawab disparitas harga dan tingginya biaya distribusi antar-pulau di wilayah kepulauan perbatasan melalui perancangan rute kapal feeder perintis terintegrasi, rantai dingin (cold chain) perikanan tenaga surya, serta rekayasa armada kapal pesisir hemat energi yang menghubungkan gugus pulau terluar dengan pusat ekonomi regional.',
                'focus_areas' => json_encode([
                    [
                        'title' => 'Optimasi Rute Multi-Moda Transportasi Laut & Feeder Tol Laut',
                        'desc'  => 'Pengembangan model optimasi matematis jaringan rute kapal perintis kepulauan untuk meminimalkan dwelling time dan menekan disparitas harga logistik sembako.',
                    ],
                    [
                        'title' => 'Desentralisasi Rantai Dingin (Cold Chain) Perikanan Pulau Kecil',
                        'desc'  => 'Implementasi cold storage portabel hemat energi berbasis PLTS di sentra tangkap nelayan pulau terpencil guna mempertahankan rantai dingin ekspor perikanan.',
                    ],
                    [
                        'title' => 'Digitalisasi Manajemen Pelabuhan Rakyat & Dermaga Perintis',
                        'desc'  => 'Sistem manifest kargo terpadu dan monitoring okupansi kapal berbasis IoT untuk meningkatkan transparansi tarif dan keamanan operasional pelabuhan tradisional.',
                    ],
                    [
                        'title' => 'Rancang Bangun Kapal Pesisir Hemat Energi & Ramah Lingkungan',
                        'desc'  => 'Desain lambung kapal cepat katamaran komposit ringan dengan propulsi elektrik atau bantuan layar hibrida untuk rute pelayaran antar-pulau.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'flagship_projects' => json_encode([
                    [
                        'title'   => 'Masterplan Sistem Logistik Maritim Terpadu Natuna-Anambas-Bintan (Silogmar Kepri)',
                        'funding' => 'Bappenas & Pemprov Kepri',
                        'period'  => '2025 - 2026',
                        'desc'    => 'Penyusunan cetak biru konektivitas logistik pulau 3T dan efisiensi rantai pasok maritim perbatasan.',
                    ],
                    [
                        'title'   => 'Pilot Project Mini Cold Storage Nelayan Mandiri Bertenaga Surya di Pulau Subi',
                        'funding' => 'Kemendikbudristek & Kemitraan Industri Perikanan',
                        'period'  => '2025',
                        'desc'    => 'Instalasi fasilitas pendingin surya kapasitas 2 ton untuk koperasi nelayan skala kecil Natuna.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'facilities' => json_encode([
                    'Laboratorium Simulasi Transportasi Laut & Pemodelan Logistik Maritim',
                    'Fasilitas Uji Coba Model Lambung Kapal Pesisir & Hidrodinamika',
                    'Pusat Data Tracking Kapal Perintis & Pemantauan Logistik Pelabuhan',
                    'Workshop Rekayasa Sistem Rantai Dingin Tenaga Surya Nelayan',
                ], JSON_UNESCAPED_UNICODE),
                'publications' => json_encode([
                    [
                        'title'   => 'Integrated Archipelago Logistics: Optimizing Feeder Routes and Inventory Transshipment for Remote Islands in Riau Archipelago',
                        'journal' => 'Maritime Policy & Management (Scopus Q1)',
                        'year'    => '2025',
                        'doi'     => '10.1080/03088839.2024.2384112',
                    ],
                    [
                        'title'   => 'Sustainable Cold Chain for Island Artisanal Fisheries: Technical and Economic Assessment of Solar Photovoltaic Cold Rooms',
                        'journal' => 'Journal of Cleaner Production (Scopus Q1)',
                        'year'    => '2024',
                        'doi'     => '10.1016/j.jclepro.2024.141209',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'created_at'  => '2025-01-01 00:00:00',
                'updated_at'  => '2025-01-01 00:00:00',
            ],
            [
                'slug'        => 'ketahanan-digital',
                'title'       => 'Ketahanan Digital Kepulauan',
                'title_en'    => 'Cluster of Archipelago Digital Resilience & Cybersecurity',
                'short_title' => 'Ketahanan Digital Kepulauan',
                'icon'        => 'fa-network-wired',
                'badge'       => 'Klaster III',
                'coordinator' => json_encode([
                    'name'      => 'Dedy Afrizal, S.Sos., M.Si., Ph.D.',
                    'nip'       => '19780824 200501 1 003',
                    'scopus_id' => '57222904882',
                    'email'     => 'dedy.afrizal@umrah.ac.id',
                    'role'      => 'Koordinator Klaster & Head of Community Service Department',
                ], JSON_UNESCAPED_UNICODE),
                'mandate'     => 'Memperkuat kedaulatan informasi dan resiliensi siber wilayah terdepan melalui pengamanan infrastruktur kritis kabel komunikasi bawah laut (submarine cables), pemantauan domain maritim berbasis satelit dan sensor terdistribusi (AIS/IoT), penguatan literasi keamanan siber di wilayah 3T, serta perancangan jaringan komunikasi darurat berdaya tahan bencana di pulau-pulau perbatasan.',
                'focus_areas' => json_encode([
                    [
                        'title' => 'Proteksi & Tata Kelola Koridor Kabel Komunikasi Bawah Laut (Submarine Cables)',
                        'desc'  => 'Mitigasi risiko kerusakan fisik akibat jangkar kapal, pemetaan zonasi koridor kabel serat optik internasional, dan kajian tata kelola kabel bawah laut di jalur ALKI I.',
                    ],
                    [
                        'title' => 'Maritime Domain Awareness (MDA) & Intelijen Spasial Satelit',
                        'desc'  => 'Pemantauan pergerakan kapal perbatasan secara real-time melalui fusi data satelit optik/SAR, Automatic Identification System (AIS), dan deteksi sinyal kapal anomali.',
                    ],
                    [
                        'title' => 'Infrastruktur Jaringan Darurat Maritim & Komunikasi Satelit LEO',
                        'desc'  => 'Pengembangan arsitektur komunikasi cadangan berbiaya rendah untuk mengeliminasi blank spot pada pulau berpenghuni terluar menggunakan konstelasi satelit orbit rendah.',
                    ],
                    [
                        'title' => 'Keamanan Siber Maritim & Literasi Digital Komunitas Perbatasan',
                        'desc'  => 'Kajian ketahanan infrastruktur komputasi pelabuhan terhadap serangan siber, privasi data perbatasan, serta edukasi keamanan digital bagi masyarakat pesisir.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'flagship_projects' => json_encode([
                    [
                        'title'   => 'Platform Spatial Dashboard Monitoring Keamanan Koridor Kabel Bawah Laut Batam-Bintan-Natuna',
                        'funding' => 'Kementerian Komunikasi dan Digital (Komdigi) & UMRAH',
                        'period'  => '2025 - 2026',
                        'desc'    => 'Sistem peringatan dini (early warning) spasial pelanggaran lego jangkar kapal niaga di atas koridor kabel serat optik strategis nasional.',
                    ],
                    [
                        'title'   => 'Pengembangan Gateway Komunikasi Darurat Berbasis Satelit & IoT untuk Nelayan Tradisional Terluar',
                        'funding' => 'Hibah Riset Terapan Kolaboratif Kemendikbudristek',
                        'period'  => '2025',
                        'desc'    => 'Prototipe radio suar maritim IoT berdaya pancar rendah untuk panggilan darurat SOS nelayan Natuna saat di laut lepas.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'facilities' => json_encode([
                    'Laboratorium Keamanan Siber Maritim & Forensik Digital (Cyber Maritime Lab)',
                    'Maritime Domain Awareness (MDA) Big Data Operations Room',
                    'Stasiun Penerima Telemetri Satelit Cuaca & Stasiun Bumi AIS Mandiri',
                    'Pusat Uji Prototipe Sensor IoT Komunikasi Darurat Kelautan',
                ], JSON_UNESCAPED_UNICODE),
                'publications' => json_encode([
                    [
                        'title'   => 'Security Assessment and Threat Modeling of International Submarine Telecommunication Cables in Archipelagic Straits',
                        'journal' => 'Computer Networks (Scopus Q1)',
                        'year'    => '2025',
                        'doi'     => '10.1016/j.comnet.2024.110521',
                    ],
                    [
                        'title'   => 'Deep Learning-Based Satellite AIS Anomaly Detection for Maritime Border Surveillance in the North Natuna Sea',
                        'journal' => 'IEEE Transactions on Intelligent Transportation Systems (Scopus Q1)',
                        'year'    => '2024',
                        'doi'     => '10.1109/TITS.2024.3398124',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'created_at'  => '2025-01-01 00:00:00',
                'updated_at'  => '2025-01-01 00:00:00',
            ],
            [
                'slug'        => 'energi',
                'title'       => 'Energi Terbarukan di Wilayah Kepulauan',
                'title_en'    => 'Cluster of Renewable Energy in Archipelago Regions',
                'short_title' => 'Energi Terbarukan Kepulauan',
                'icon'        => 'fa-bolt',
                'badge'       => 'Klaster IV',
                'coordinator' => json_encode([
                    'name'      => 'Ahmad Rusdi, M.T.',
                    'nip'       => '19850615 201404 1 001',
                    'scopus_id' => 'SINTA ID: 6718290',
                    'email'     => 'ahmad.rusdi@umrah.ac.id',
                    'role'      => 'Koordinator Klaster & Pakar Energi Terbarukan Kepulauan',
                ], JSON_UNESCAPED_UNICODE),
                'mandate'     => 'Mengakselerasi transisi energi bersih dan mewujudkan kemandirian listrik 24 jam di wilayah kepulauan terdepan 3T melalui pemanfaatan energi hidrokinetik arus laut selat sempit, sistem pembangkit surya terapung (floating solar PV), mikrogrid hibrida pulau mandiri energi, serta pemanfaatan energi hijau untuk elektrifikasi perahu nelayan dan desalinasi air bersih.',
                'focus_areas' => json_encode([
                    [
                        'title' => 'Turbin Pembangkit Arus Laut Selat Sempit Hidrokinetik',
                        'desc'  => 'Rancang bangun prototipe turbin sumbu vertikal kecepatan rendah yang mampu menghasilkan listrik stabil pada kecepatan arus 1.0 - 2.2 m/s di selat-selat sempit Kepri.',
                    ],
                    [
                        'title' => 'Pembangkit Listrik Tenaga Surya Terapung (Floating Solar PV) Pesisir',
                        'desc'  => 'Rekayasa sistem pelampung fotovoltaik tahan salinitas dan ombak pada teluk terlindung pulau kecil untuk meminimalkan penggunaan lahan daratan yang terbatas.',
                    ],
                    [
                        'title' => 'Mikrogrid Cerdas Hibrida & Sistem Penyimpanan Energi Baterai (BESS) 3T',
                        'desc'  => 'Desain otomasi integrasi panel surya, generator biomassa, dan battery storage guna menggantikan konsumsi BBM genset diesel di pulau-pulau terpencil.',
                    ],
                    [
                        'title' => 'Elektrifikasi Perahu Nelayan & Desalinasi Air Bersih Tenaga Surya',
                        'desc'  => 'Pengembangan propulsi motor listrik ramah lingkungan untuk sampan nelayan tradisional dan unit destilasi reverse osmosis bertenaga surya untuk air minum warga pesisir.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'flagship_projects' => json_encode([
                    [
                        'title'   => 'Pilot Project Turbin Arus Laut Hidrokinetik 10 kW di Selat Sempit Tiang Wangi Natuna',
                        'funding' => 'Kementerian ESDM & BRIN Kolaborasi UMRAH',
                        'period'  => '2025 - 2026',
                        'desc'    => 'Uji kinerja turbin hidrokinetik skala lapangan untuk memasok listrik komunitas nelayan terisolir.',
                    ],
                    [
                        'title'   => 'Penerapan Smart Microgrid PLTS Terapung & Desalinasi Surya untuk Dusun Pesisir Pulau Midai',
                        'funding' => 'Pemprov Kepri & CSR Energi Bersih',
                        'period'  => '2025',
                        'desc'    => 'Penyediaan pasokan listrik dan air bersih layak minum berbasis 100% energi baru terbarukan.',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'facilities' => json_encode([
                    'Laboratorium Konversi Energi Laut & Uji Hidrodinamika Turbin Arus',
                    'Fasilitas Pengujian Ketahanan Korosi Salinitas Panel Surya Apung',
                    'Workstation Simulasi Jaringan Mikrogrid & Battery Management System (BMS)',
                    'Stasiun Percobaan Desalinasi Air Minum Tenaga Surya Pesisir',
                ], JSON_UNESCAPED_UNICODE),
                'publications' => json_encode([
                    [
                        'title'   => 'Hydrokinetic Current Energy Potential and Low-Velocity Turbine Design in Narrow Straits of Riau Archipelago',
                        'journal' => 'Renewable and Sustainable Energy Reviews (Scopus Q1)',
                        'year'    => '2025',
                        'doi'     => '10.1016/j.rser.2024.114782',
                    ],
                    [
                        'title'   => 'Techno-Economic Analysis of Hybrid Solar-Battery Microgrids for 100% Electrification of Remote Small Islands in Natuna',
                        'journal' => 'Energy for Sustainable Development (Scopus Q1)',
                        'year'    => '2024',
                        'doi'     => '10.1016/j.esd.2024.101438',
                    ],
                ], JSON_UNESCAPED_UNICODE),
                'created_at'  => '2025-01-01 00:00:00',
                'updated_at'  => '2025-01-01 00:00:00',
            ],
        ];

        $builder = $this->db->table('klaster_riset');
        $builder->truncate();
        $builder->insertBatch($clusters);
    }
}
