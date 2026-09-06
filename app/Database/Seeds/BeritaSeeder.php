<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title'          => 'Didukung Pendanaan dari Pulitzer Center, UMRAH dan UNS Kolaborasi Riset Internasional',
                'slug'           => 'didukung-pendanaan-dari-pulitzer-center-umrah-dan-uns-kolaborasi-riset-internasional',
                'category'       => 'Kerjasama Riset',
                'date_formatted' => '06 September 2026',
                'author'         => 'Rachma Indriyani, S.H., LL.M., Ph.D. & Tim Peneliti',
                'author_role'    => 'Tim Peneliti Pusat Studi Laut Natuna Utara UMRAH & Fakultas Hukum UNS',
                'read_time'      => '4 menit baca',
                'image'          => 'images/berita/pulitzer_center_umrah_uns.jpg',
                'image_caption'  => 'Suasana pertemuan para peneliti UMRAH dan UNS dalam riset internasional yang mengkaji celah hukum dalam pengawasan beneficial ownership pada praktik illegal fishing di perairan Natuna. (Foto: Dok. UMRAH / Prokepri)',
                'tag'            => 'Riset Internasional',
                'tags'           => json_encode(['Pulitzer Center', 'Riset Internasional', 'UNS', 'Illegal Fishing', 'Natuna', 'Beneficial Ownership'], JSON_UNESCAPED_UNICODE),
                'excerpt'        => 'Universitas Maritim Raja Ali Haji (UMRAH) berkolaborasi dengan UNS dalam riset internasional yang mengkaji celah hukum pengawasan beneficial ownership pada praktik illegal fishing di perairan Natuna dengan dukungan pendanaan Pulitzer Center Washington DC.',
                'key_takeaways'  => json_encode([
                    'Mendapat dukungan pendanaan riset internasional dari Pulitzer Center, lembaga bergengsi yang berbasis di Washington DC, Amerika Serikat.',
                    'Melibatkan dewan peneliti Pusat Studi Laut Natuna Utara UMRAH: Rachma Indriyani sebagai ketua, bersama Atika Thahira, Ady Muzwardi, Dedy Afrizal, dan tim Fakultas Hukum UNS.',
                    'Investigasi empiris menelusuri keputusan hukum pelaku kejahatan illegal fishing dan pengawasan beneficial ownership di wilayah Batam, Natuna, dan Tanjungpinang.',
                    'Membangun kolaborasi strategis dengan Bakamla Zona Barat, PSDKP Batam, Dinas Perikanan Natuna, serta Pengadilan Negeri Ranai & Tanjungpinang.',
                    'Menghasilkan Policy Brief komprehensif, penyempurnaan implementasi UU Perikanan & KUHAP, serta bahan ajar kurikulum akademik perguruan tinggi.'
                ], JSON_UNESCAPED_UNICODE),
                'content'        => json_encode([
                    'Universitas Maritim Raja Ali Haji (UMRAH) berkolaborasi dengan Universitas Sebelas Maret (UNS) dalam riset internasional yang mengkaji celah hukum dalam pengawasan beneficial ownership pada praktik illegal fishing di perairan Natuna. Riset ini mendapat dukungan pendanaan bergengsi dari Pulitzer Center, lembaga internasional yang berkantor pusat di Washington DC, Amerika Serikat.',
                    'Riset bertajuk “Regulatory Blind Spots: Tinjauan Celah Hukum dalam Pengawasan terhadap the Beneficial Ownership pada Praktik Illegal Fishing di Perairan Natuna” tersebut dilaksanakan selama tiga bulan, terhitung sejak 11 Agustus hingga 11 November 2026. Kolaborasi ini menjadi bagian dari komitmen nyata UMRAH dan UNS memperkuat riset lintas institusi di kawasan perbatasan, khususnya dalam perspektif hukum internasional dan ketahanan maritim nasional.',
                    'Riset ini melibatkan tim ahli yang terdiri atas dua peneliti bidang Hukum Internasional dari Fakultas Hukum UNS dan para peneliti dari Pusat Studi Laut Natuna Utara UMRAH. Tim dipimpin langsung oleh Rachma Indriyani, S.H., LL.M., Ph.D. sebagai ketua, serta didukung oleh Dr. Atika Thahira, S.H., M.H. (Koordinator Pusat Studi), Dr. Ady Muzwardi, S.IP., M.A., M.H.I., Dedy Afrizal, S.Sos., M.Si., Ph.D., dan Diah Apriani Atika Sari. Selain dewan pakar, kolaborasi ini juga membuka ruang keterlibatan mahasiswa untuk memberikan pengalaman lapangan investigasi empiris di pulau-pulau perbatasan.',
                    'Untuk memperoleh gambaran yang komprehensif, tim peneliti melakukan investigasi mendalam terhadap putusan hukum tindak pidana perikanan di wilayah Kepulauan Natuna. Pengumpulan data primer dilakukan melalui observasi lapangan dan wawancara di Batam, Natuna, dan Tanjungpinang dengan menggandeng Markas Komando (Mako) Badan Keamanan Laut (Bakamla) Zona Barat, Pangkalan Pengawasan Sumber Daya Kelautan dan Perikanan (PSDKP) Batam, Dinas Perikanan Kabupaten Natuna, Pengadilan Negeri Ranai, serta Pengadilan Negeri Tanjungpinang.',
                    'Salah satu keluaran utama yang ditargetkan dari riset ini adalah perumusan Policy Brief sebagai bahan rekomendasi kebijakan berkelanjutan bagi kementerian dan lembaga pertahanan laut. Kajian ini meninjau efektivitas UU Perikanan, KUHAP baru, penelusuran korporasi di balik kapal ikan asing ilegal, serta format kerja sama penegakan hukum antar-negara di perairan Laut Natuna Utara.'
                ], JSON_UNESCAPED_UNICODE),
                'is_featured'    => 1,
                'published_at'   => '2026-09-06 17:11:44',
                'created_at'     => '2026-09-06 17:11:44',
                'updated_at'     => '2026-09-06 17:11:44',
            ],
            [
                'title'          => 'UMRAH Luncurkan 5 Pusat Studi Baru dan MITC, Fokus Isu Strategis Kepri',
                'slug'           => 'umrah-luncurkan-5-pusat-studi-baru-dan-mitc-fokus-isu-strategis-kepri',
                'category'       => 'Kelembagaan',
                'date_formatted' => '04 Mei 2026',
                'author'         => 'Humas UMRAH / Batam Pos',
                'author_role'    => 'Pusat Komunikasi Publik UMRAH',
                'read_time'      => '3 menit baca',
                'image'          => 'images/berita/peluncuran_5_pusat_studi_umrah.jpg',
                'image_caption'  => 'Rektor UMRAH Prof. Agung Dhamar Syakti bersama Kapolda Kepri Irjen Pol Asep Safrudin dan Wagub Kepri saat peluncuran resmi Pusat Studi Laut Natuna Utara di ajang UMRAH Nexus Expo 2026. (Foto: Batam Pos)',
                'tag'            => 'Peluncuran Pusat Studi',
                'tags'           => json_encode(['Pusat Studi', 'Laut Natuna Utara', 'Hardiknas', 'UMRAH Nexus Expo', 'Polda Kepri', 'MITC'], JSON_UNESCAPED_UNICODE),
                'excerpt'        => 'UMRAH resmi mengoperasikan 5 pusat studi strategis termasuk Pusat Studi Laut Natuna Utara dan MITC bertepatan dengan Hardiknas 2026, memperkuat riset perbatasan bersama Polda dan Pemprov Kepri.',
                'key_takeaways'  => json_encode([
                    'UMRAH meresmikan operasional 5 pusat studi baru dan Mangrove Information Training Center (MITC) pada perhelatan UMRAH Nexus Expo 2026 bertepatan dengan Hardiknas.',
                    'Pusat Studi Laut Natuna Utara menjadi ujung tombak sains dan kebijakan dalam memperkuat sektor kemaritiman dan kedaulatan perbatasan di Kepri.',
                    'Sinergi strategis terjalin antara civitas akademika UMRAH, Polda Kepri, dan Pemerintah Provinsi Kepulauan Riau.',
                    'Riset diarahkan secara aplikatif untuk menjawab kebutuhan konkret pengelolaan sumber daya laut, pesisir, dan pembangunan wilayah.'
                ], JSON_UNESCAPED_UNICODE),
                'content'        => json_encode([
                    'Universitas Maritim Raja Ali Haji (UMRAH) resmi mengoperasikan lima pusat studi strategis dan Mangrove Information Training Center (MITC) sebagai langkah terobosan memperkuat riset berbasis kebutuhan daerah serta menjawab isu-isu krusial di Provinsi Kepulauan Riau.',
                    'Peluncuran resmi tersebut dilangsungkan dalam rangkaian kegiatan UMRAH Nexus Expo 2026 yang bertepatan dengan peringatan Hari Pendidikan Nasional (Hardiknas) di kampus terpadu UMRAH Tanjungpinang.',
                    'Rektor UMRAH, Prof. Dr. Agung Dhamar Syakti, S.Pi., DEA, menjelaskan bahwa lima pusat studi yang diresmikan meliputi Pusat Studi Laut Natuna Utara, Pusat Studi Mitigasi Bencana, Sustainable Development Goals (SDGs) Center, Pusat Studi Kepolisian, serta Pusat Kajian Perencanaan, Infrastruktur, dan Kewilayahan.',
                    '“Salah satu fokus utama kami adalah Pusat Studi Laut Natuna Utara guna memperkuat sektor kemaritiman, pengawasan kedaulatan sains, dan potensi kelautan di Kepulauan Riau. Riset yang dilakukan tidak hanya bernilai akademis, melainkan diarahkan menjawab kebutuhan konkret masyarakat pesisir dan ketahanan perbatasan,” tegas Rektor UMRAH.',
                    'Kapolda Kepri, Irjen Pol Asep Safrudin, serta Wakil Gubernur Kepri, Nyanyang Haris Pratamura, menyambut baik dan memberikan dukungan penuh. Kolaborasi antara kepolisian, pemerintah daerah, dan akademisi dinilai sebagai langkah vital agar penanganan persoalan kamtibmas perairan dan pelestarian ekosistem laut Kepri dapat diselesaikan dengan pendekatan saintifik yang komprehensif.'
                ], JSON_UNESCAPED_UNICODE),
                'is_featured'    => 1,
                'published_at'   => '2026-05-04 09:30:08',
                'created_at'     => '2026-05-04 09:30:08',
                'updated_at'     => '2026-05-04 09:30:08',
            ],
            [
                'title'          => 'BSKLN Kemlu dan UMRAH Bentuk Pusat Studi Laut Natuna Utara dan Laut China Selatan',
                'slug'           => 'bskln-kemlu-umrah-bentuk-pusat-studi-laut-natuna-utara-dan-laut-china-selatan',
                'category'       => 'Kerjasama Strategis',
                'date_formatted' => '10 Maret 2026',
                'author'         => 'Badan Strategi Kebijakan Luar Negeri (BSKLN) Kemlu RI',
                'author_role'    => 'Kementerian Luar Negeri RI & LPPM UMRAH',
                'read_time'      => '4 menit baca',
                'image'          => 'images/berita/bskln_kemlu_umrah_mou.jpg',
                'image_caption'  => 'Kepala BSKLN Kemlu RI Dr. Yayan G.H. Mulyana dan Rektor UMRAH Prof. Agung Dhamar Syakti menandatangani MoU pembentukan Pusat Studi Laut Natuna Utara di Ruang Tanjak UMRAH Dompak. (Foto: Dok. Kemlu / Niaga.Asia)',
                'tag'            => 'Diplomasi Maritim',
                'tags'           => json_encode(['BSKLN Kemlu', 'Kementerian Luar Negeri', 'Pusat Studi Laut Natuna Utara', 'Diplomasi Maritim', 'Laut China Selatan', 'UNCLOS'], JSON_UNESCAPED_UNICODE),
                'excerpt'        => 'Badan Strategi Kebijakan Luar Negeri (BSKLN) Kemlu RI dan UMRAH resmi menandatangani MoU pembentukan Pusat Studi Laut Natuna Utara guna mengoptimalkan kajian diplomasi dan kebijakan perbatasan.',
                'key_takeaways'  => json_encode([
                    'Penandatanganan Nota Kesepahaman (MoU) resmi antara BSKLN Kementerian Luar Negeri RI dan UMRAH dalam pendirian Pusat Studi Laut Natuna Utara.',
                    'Bertujuan mengoptimalkan perumusan strategi kebijakan luar negeri dan diplomasi maritim Indonesia di perairan Natuna dan dinamika Laut China Selatan.',
                    'UMRAH diposisikan sebagai think-tank maritim perbatasan yang berhadapan langsung dengan koridor strategis perairan internasional.',
                    'Rangkaian kegiatan mencakup Focus Group Discussion (FGD) evaluasi workshop konflik kawasan serta kuliah umum geopolitik Indo-Pasifik bagi civitas akademika.'
                ], JSON_UNESCAPED_UNICODE),
                'content'        => json_encode([
                    'Badan Strategi Kebijakan Luar Negeri (BSKLN), Kementerian Luar Negeri Republik Indonesia, menandatangani nota kesepahaman (MoU) kerja sama dengan Universitas Maritim Raja Ali Haji (UMRAH), Tanjungpinang, Kepulauan Riau, dalam membentuk Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) dan Pusat Studi Laut China Selatan.',
                    '“Kerja sama strategis ini dirancang guna mengoptimalkan pengkajian dan perumusan arah kebijakan luar negeri Indonesia, khususnya dalam merespons dinamika di perairan Laut Natuna Utara dan kawasan Laut China Selatan,” papar Kepala BSKLN Kemlu RI, Dr. Yayan G.H. Mulyana.',
                    'Menurut Dr. Yayan, pemilihan UMRAH sebagai mitra strategis diplomasi maritim nasional sangat tepat mengingat posisi geografis UMRAH berada di garis terdepan kepulauan Indonesia yang berbatasan langsung dengan perairan internasional.',
                    'Penandatanganan kerja sama ini dilaksanakan di sela penyelenggaraan Focus Group Discussion (FGD) Evaluasi Penyelenggaraan Workshop Pengelolaan Potensi Konflik di Laut China Selatan bertempat di Ruang Tanjak, Gedung Rektorat UMRAH Dompak, yang menghadirkan pakar hukum laut dan hubungan internasional terkemuka tanah air.',
                    'Selain penandatanganan MoU, Dr. Yayan Mulyana turut memberikan kuliah umum bertajuk “Dimensi Maritim dalam Dinamika Indo-Pasifik” di hadapan ratusan mahasiswa dan dosen UMRAH, menegaskan pentingnya postur ketahanan maritim dan diplomasi ekonomi biru (blue economy) bagi masa depan Indonesia.'
                ], JSON_UNESCAPED_UNICODE),
                'is_featured'    => 1,
                'published_at'   => '2026-03-10 11:00:00',
                'created_at'     => '2026-03-10 11:00:00',
        ];

        $builder = $this->db->table('berita');
        $builder->truncate();
        $builder->insertBatch($articles);
    }
}

