<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnduhanSeeder extends Seeder
{
    public function run()
    {
        $documents = [
            // 1. SOP Laboratorium (4 docs)
            [
                'code'        => 'SOP-PSK-01',
                'slug'        => 'sop-oseanografi',
                'title'       => 'SOP Pelaksanaan Survei Batimetri dan Pemetaan Akustik Bawah Laut',
                'category'    => 'SOP Laboratorium',
                'category_id' => 'sop',
                'file_type'   => 'PDF',
                'file_size'   => '2.4 MB',
                'year'        => '2026',
                'downloads'   => 342,
                'desc'        => 'Prosedur standar kalibrasi multibeam sonar, instalasi sensor pasang surut, sound velocity profile (SVP), dan pemrosesan data kedalaman sesuai standar IHO S-44.',
                'created_at'  => '2026-01-15 08:00:00',
                'updated_at'  => '2026-01-15 08:00:00',
            ],
            [
                'code'        => 'SOP-PSK-02',
                'slug'        => 'sop-mutu-air',
                'title'       => 'SOP Pengambilan Sampel dan Uji Mutu Air Laut Terakreditasi',
                'category'    => 'SOP Laboratorium',
                'category_id' => 'sop',
                'file_type'   => 'PDF',
                'file_size'   => '1.8 MB',
                'year'        => '2025',
                'downloads'   => 289,
                'desc'        => 'Standar operasional baku mutu air laut untuk perikanan budidaya, wisata bahari, dan pemantauan perairan industri pelabuhan sesuai regulasi PP No. 22 Tahun 2021.',
                'created_at'  => '2025-11-20 08:00:00',
                'updated_at'  => '2025-11-20 08:00:00',
            ],
            [
                'code'        => 'SOP-PSK-03',
                'slug'        => 'sop-blue-carbon',
                'title'       => 'SOP Inventarisasi dan Penghitungan Cadangan Karbon Biru Mangrove',
                'category'    => 'SOP Laboratorium',
                'category_id' => 'sop',
                'file_type'   => 'PDF',
                'file_size'   => '2.1 MB',
                'year'        => '2025',
                'downloads'   => 415,
                'desc'        => 'Metodologi terstandarisasi sampling biomassa pohon atas dan bawah, nekromassa, serta penghitungan cadangan karbon sedimen tanah mangrove pulau-pulau Kepri.',
                'created_at'  => '2025-10-10 08:00:00',
                'updated_at'  => '2025-10-10 08:00:00',
            ],
            [
                'code'        => 'SOP-PSK-04',
                'slug'        => 'sop-drone-pantai',
                'title'       => 'SOP Pengoperasian Drone Nirawak untuk Pemetaan Garis Pantai',
                'category'    => 'SOP Laboratorium',
                'category_id' => 'sop',
                'file_type'   => 'PDF',
                'file_size'   => '1.5 MB',
                'year'        => '2026',
                'downloads'   => 198,
                'desc'        => 'Panduan keselamatan penerbangan pesisir, penentuan Ground Control Points (GCP) geodetik, dan pengolahan ortofoto resolusi tinggi untuk monitoring abrasi.',
                'created_at'  => '2026-02-01 08:00:00',
                'updated_at'  => '2026-02-01 08:00:00',
            ],

            // 2. Policy Brief & Publikasi (2 docs)
            [
                'code'        => 'PB-PSK-05',
                'slug'        => 'pb-diplomasi-perbatasan-natuna',
                'title'       => 'Policy Brief: Upaya Pengelolaan Kawasan Perbatasan Untuk Mendukung Strategi Diplomasi Menegakkan Kedaulatan Wilayah Di Laut Natuna Utara',
                'category'    => 'Policy Brief & Publikasi',
                'category_id' => 'policy-brief',
                'file_type'   => 'PDF',
                'file_size'   => '3.8 MB',
                'year'        => '2026',
                'downloads'   => 412,
                'desc'        => 'Implementasi pengelolaan kawasan perbatasan untuk mendukung strategi diplomasi menegakkan kedaulatan wilayah di perbatasan terluar Indonesia di Laut Natuna Utara didukung oleh beberapa kebijakan baik dari Kebijakan Pemerintah Pusat dan Pemerintah Daerah. Penyusun: Dr. Ady Muzwardi dan Tim Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI.',
                'created_at'  => '2026-03-01 08:00:00',
                'updated_at'  => '2026-03-01 08:00:00',
            ],
            [
                'code'        => 'PB-PSK-06',
                'slug'        => 'pb-kpbpb-perbatasan-maritim',
                'title'       => 'Policy Brief: Optimalisasi Pengembangan Kawasan Perdagangan Bebas Dan Pelabuhan Bebas',
                'category'    => 'Policy Brief & Publikasi',
                'category_id' => 'policy-brief',
                'file_type'   => 'PDF',
                'file_size'   => '3.6 MB',
                'year'        => '2026',
                'downloads'   => 385,
                'desc'        => 'Kawasan-kawasan strategis untuk menopang pembangunan ekonomi daerah dan nasional. Kawasan Perdagangan Bebas dan Pelabuhan Bebas (KPBPB) adalah salah satu model yang dikembangkan pemerintah dalam mewujudkan Pembangunan di wilayah perbatasan. Penyusun: Dr. Ady Muzwardi dan Pusat Strategi Kebijakan Kawasan Asia Pasifik dan Afrika Badan Strategi Kebijakan Luar Negeri Kementerian Luar Negeri RI.',
                'created_at'  => '2026-03-05 08:00:00',
                'updated_at'  => '2026-03-05 08:00:00',
            ],

            // 3. Template & Kerjasama (3 docs)
            [
                'code'        => 'FORM-PSK-01',
                'slug'        => 'form-pengajuan-riset',
                'title'       => 'Formulir Pengajuan Inisiasi Kerjasama Riset dan Studi Kelautan',
                'category'    => 'Template & Kerjasama',
                'category_id' => 'template',
                'file_type'   => 'DOCX',
                'file_size'   => '420 KB',
                'year'        => '2026',
                'downloads'   => 612,
                'desc'        => 'Format baku permohonan kerjasama penelitian, kajian kelayakan maritim, dan survei lapangan dari kementerian, pemerintah daerah, BUMN, dan sektor swasta.',
                'created_at'  => '2026-01-05 08:00:00',
                'updated_at'  => '2026-01-05 08:00:00',
            ],
            [
                'code'        => 'FORM-PSK-02',
                'slug'        => 'form-mou-pks',
                'title'       => 'Template Nota Kesepahaman (MoU) & Perjanjian Kerjasama (PKS) Kemaritiman',
                'category'    => 'Template & Kerjasama',
                'category_id' => 'template',
                'file_type'   => 'DOCX',
                'file_size'   => '510 KB',
                'year'        => '2026',
                'downloads'   => 443,
                'desc'        => 'Draft klausul hukum standar kerjasama kelembagaan, kepemilikan Hak Kekayaan Intelektual (HKI), publikasi bersama, dan pembagian hak data riset kelautan.',
                'created_at'  => '2026-01-05 08:00:00',
                'updated_at'  => '2026-01-05 08:00:00',
            ],
            [
                'code'        => 'FORM-PSK-03',
                'slug'        => 'form-sewa-lab',
                'title'       => 'Formulir Permohonan Penggunaan Laboratorium Komputasi GIS & Wahana Riset',
                'category'    => 'Template & Kerjasama',
                'category_id' => 'template',
                'file_type'   => 'DOCX',
                'file_size'   => '380 KB',
                'year'        => '2026',
                'downloads'   => 275,
                'desc'        => 'Formulir reservasi perangkat komputasi geospasial, workstation analisis citra satelit, drone survei pantai, dan kapal riset mini Seabird Kampus Dompak.',
                'created_at'  => '2026-01-05 08:00:00',
                'updated_at'  => '2026-01-05 08:00:00',
            ],

            // 4. Panduan & Regulasi (2 docs)
            [
                'code'        => 'GUIDE-PSK-01',
                'slug'        => 'panduan-hibah-malaka',
                'title'       => 'Panduan Program Hibah Riset Kolaboratif Kemaritiman Selat Malaka 2026',
                'category'    => 'Panduan & Regulasi',
                'category_id' => 'panduan',
                'file_type'   => 'PDF',
                'file_size'   => '2.7 MB',
                'year'        => '2026',
                'downloads'   => 780,
                'desc'        => 'Buku panduan lengkap ketentuan pengajuan proposal hibah riset, rincian anggaran biaya (RAB), jadwal seleksi, dan luaran wajib jurnal internasional bereputasi.',
                'created_at'  => '2026-01-02 08:00:00',
                'updated_at'  => '2026-01-02 08:00:00',
            ],
            [
                'code'        => 'REG-PSK-01',
                'slug'        => 'regulasi-etik-kemaritiman',
                'title'       => 'Kode Etik Riset Lapangan Kelautan & Keselamatan Operasional Perairan',
                'category'    => 'Panduan & Regulasi',
                'category_id' => 'panduan',
                'file_type'   => 'PDF',
                'file_size'   => '1.9 MB',
                'year'        => '2025',
                'downloads'   => 310,
                'desc'        => 'Regulasi keselamatan kerja maritim (K3), standar operasional perlindungan periset di laut, perizinan survei perairan perbatasan, dan etika penanganan sampel biota.',
                'created_at'  => '2025-09-15 08:00:00',
                'updated_at'  => '2025-09-15 08:00:00',
            ],
        ];

        $builder = $this->db->table('unduhan');
        $builder->truncate();
        $builder->insertBatch($documents);
    }
}

