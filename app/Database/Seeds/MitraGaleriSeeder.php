<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MitraGaleriSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // 1. Seed Mitra Kerjasama
        $db->table('mitra_kerjasama')->truncate();
        try {
            $db->query("DELETE FROM sqlite_sequence WHERE name = 'mitra_kerjasama'");
        } catch (\Throwable $e) {}

        $mitraData = [
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
                'name'        => 'Universitas Sebelas Maret',
                'short_name'  => 'UNS Surakarta',
                'category'    => 'perguruan_tinggi',
                'logo'        => 'images/partners/logo_uns.svg',
                'website_url' => 'https://uns.ac.id',
                'order_seq'   => 6,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Pulitzer Center on Crisis Reporting',
                'short_name'  => 'Pulitzer Center',
                'category'    => 'internasional',
                'logo'        => 'images/partners/logo_pulitzer.svg',
                'website_url' => 'https://pulitzercenter.org',
                'order_seq'   => 7,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'Nanyang Technological University',
                'short_name'  => 'NTU Singapore',
                'category'    => 'internasional',
                'logo'        => 'images/partners/logo_ntu.svg',
                'website_url' => 'https://ntu.edu.sg',
                'order_seq'   => 8,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];
        $db->table('mitra_kerjasama')->insertBatch($mitraData);

        // 2. Seed Galeri Riset
        $db->table('galeri_riset')->truncate();
        try {
            $db->query("DELETE FROM sqlite_sequence WHERE name = 'galeri_riset'");
        } catch (\Throwable $e) {}

        $galeriData = [
            [
                'title'          => 'Ekspedisi Oseanografi Selat Riau & Batimetri Laut Dalam 2026',
                'title_en'       => 'Riau Strait Oceanographic Expedition & Deep-Sea Bathymetry 2026',
                'category'       => 'ekspedisi',
                'image'          => 'images/galeri/ekspedisi_selat_riau_2026.jpg',
                'date_text'      => 'Februari 2026',
                'date_text_en'   => 'February 2026',
                'location'       => 'Perairan Selat Riau - Pulau Pengibu',
                'location_en'    => 'Riau Strait Waters - Pengibu Island',
                'vessel'         => 'KM. Raja Ali Haji Explorer',
                'vessel_en'      => 'RV Raja Ali Haji Explorer',
                'focal'          => 'Dr. Ady Muzwardi & Tim Oseanografi',
                'focal_en'       => 'Dr. Ady Muzwardi & Oceanography Team',
                'desc'           => 'Survei batimetri akustik multibeam dan perekaman profil hidrodinamika arus pasang surut untuk pemodelan koridor pelayaran pulau terluar.',
                'desc_en'        => 'Multibeam acoustic bathymetric survey and tidal current hydrodynamic profiling for outermost island shipping corridor modeling.',
                'order_seq'      => 1,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'title'          => 'Pengambilan Sampel Air Laut & Pengujian Mutu Baku Mutu Perairan Pelabuhan',
                'title_en'       => 'Seawater Quality Sampling & Port Environmental Standards Testing',
                'category'       => 'laboratorium',
                'image'          => 'images/galeri/pengujian_kualitas_air_lab.jpg',
                'date_text'      => 'Januari 2026',
                'date_text_en'   => 'January 2026',
                'location'       => 'Lab Kimia Oseanografi Kampus Dompak',
                'location_en'    => 'Oceanographic Chemistry Lab, Dompak Campus',
                'vessel'         => null,
                'vessel_en'      => null,
                'focal'          => 'Tim Analisis Baku Mutu Air Laut',
                'focal_en'       => 'Seawater Standards Analysis Team',
                'desc'           => 'Pengukuran parameter fisika-kimia air laut menggunakan CTD probe dan spektrofotometer UV-Vis berstandar ISO/IEC 17025.',
                'desc_en'        => 'Physico-chemical parameter testing of marine waters using CTD probe and UV-Vis spectrophotometer compliant with ISO/IEC 17025.',
                'order_seq'      => 2,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'title'          => 'Monitoring Stok Karbon Biru & Pemetaan Hutan Mangrove Natuna',
                'title_en'       => 'Blue Carbon Stock Monitoring & Natuna Mangrove Ecosystem Mapping',
                'category'       => 'blue-carbon',
                'image'          => 'images/galeri/monitoring_blue_carbon_natuna.jpg',
                'date_text'      => 'Desember 2025',
                'date_text_en'   => 'December 2025',
                'location'       => 'Kawasan Pesisir Sedanau, Kepulauan Natuna',
                'location_en'    => 'Sedanau Coastal Zone, Natuna Regency',
                'vessel'         => 'Perahu Riset Pesisir Komunitas',
                'vessel_en'      => 'Coastal Community Research Craft',
                'focal'          => 'Peneliti Ekologi Mangrove & Blue Carbon',
                'focal_en'       => 'Mangrove Ecology & Blue Carbon Fellows',
                'desc'           => 'Inventarisasi cadangan karbon sedimen dan biomassa pohon mangrove untuk mendukung pencapaian target NDC kelautan Indonesia.',
                'desc_en'        => 'Sediment carbon stock inventory and mangrove tree biomass assessment supporting Indonesia\'s marine NDC targets.',
                'order_seq'      => 3,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'title'          => 'Pemasangan Sensor Akustik Pasif Pemantauan Mamalia Laut & Hidrofon Bawah Air',
                'title_en'       => 'Passive Acoustic Sensor Deployment for Marine Mammals & Underwater Hydrophone',
                'category'       => 'laboratorium',
                'image'          => 'images/galeri/instalasi_sensor_akustik_laut.jpg',
                'date_text'      => 'November 2025',
                'date_text_en'   => 'November 2025',
                'location'       => 'Perairan Karang Singa - Bintan Timur',
                'location_en'    => 'Karang Singa Waters - East Bintan',
                'vessel'         => 'KM. Raja Ali Haji Explorer',
                'vessel_en'      => 'RV Raja Ali Haji Explorer',
                'focal'          => 'Laboratorium Instrumentasi Bawah Air',
                'focal_en'       => 'Underwater Instrumentation Laboratory',
                'desc'           => 'Instalasi rangkaian hidrofon bawah air mandiri untuk memantau kebisingan kapal dan migrasi fauna laut perbatasan.',
                'desc_en'        => 'Autonomous underwater hydrophone array installation to monitor maritime shipping noise and transboundary marine fauna migration.',
                'order_seq'      => 4,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ];
        $db->table('galeri_riset')->insertBatch($galeriData);
    }
}

