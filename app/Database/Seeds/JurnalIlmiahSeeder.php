<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JurnalIlmiahSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        $journals = [
            [
                'slug'           => 'jurnal-akuatiklestari',
                'name'           => 'Jurnal Akuatiklestari',
                'name_en'        => 'Jurnal Akuatiklestari',
                'indexing'       => 'SINTA 3 / Crossref / Garuda',
                'issn'           => 'e-ISSN: 2598-8204',
                'description'    => 'Jurnal ilmiah terakreditasi SINTA 3 yang dikelola Program Studi Manajemen Sumberdaya Perairan, FIKP UMRAH. Memuat kajian ekologi laut tropis, oseanografi, mutu air laut, konservasi, dan tata kelola pesisir.',
                'description_en' => 'Accredited SINTA 3 scholarly journal managed by Aquatic Resources Management, FIKP UMRAH. Focuses on marine ecology, tropical oceanography, marine water quality, conservation, and coastal ecosystem governance.',
                'frequency'      => 'Terbit 2x Setahun',
                'frequency_en'   => 'Biannual Publication',
                'journal_url'    => 'https://ojs.umrah.ac.id/index.php/akuatiklestari',
                'cover_image'    => null,
                'order_num'      => 1,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'slug'           => 'khidmat-journal-of-community-service',
                'name'           => 'Khidmat: Journal of Community Service',
                'name_en'        => 'Khidmat: Journal of Community Service',
                'indexing'       => 'Google Scholar / Garuda / Crossref',
                'issn'           => 'e-ISSN: 2684-8244 | p-ISSN: 2598-5035',
                'description'    => 'Jurnal resmi terbitan Pusat Studi Kebijakan dan Tata Kelola Kemaritiman / LPPM UMRAH. Memuat diseminasi riset pengabdian masyarakat pesisir, pemberdayaan ekonomi nelayan, dan advokasi kebijakan kelautan.',
                'description_en' => 'Official journal published by the Center for Maritime Policy and Governance Studies (CMPGS) / LPPM UMRAH. Dedicated to maritime community empowerment, coastal economics, and marine public policy dissemination.',
                'frequency'      => 'Terbit 2x Setahun',
                'frequency_en'   => 'Biannual Publication',
                'journal_url'    => 'https://ojs.umrah.ac.id/index.php/khidmat',
                'cover_image'    => null,
                'order_num'      => 2,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'slug'           => 'jurnal-marinade',
                'name'           => 'Jurnal Marinade',
                'name_en'        => 'Jurnal Marinade',
                'indexing'       => 'Google Scholar / Garuda / Crossref',
                'issn'           => 'e-ISSN: 2654-4415',
                'description'    => 'Jurnal ilmiah kelautan yang dikelola Program Studi Teknologi Hasil Perikanan, FIKP UMRAH. Berfokus pada bioteknologi perikanan bahari, pascapanen tangkapan laut, diversifikasi pangan, dan bioproduk pesisir.',
                'description_en' => 'Scientific journal managed by Marine Fisheries Product Technology, FIKP UMRAH. Covers marine biotechnology, post-harvest fishery processing, seafood food safety, and coastal marine bioproducts.',
                'frequency'      => 'Terbit 2x Setahun',
                'frequency_en'   => 'Biannual Publication',
                'journal_url'    => 'https://ojs.umrah.ac.id/index.php/marinade',
                'cover_image'    => null,
                'order_num'      => 3,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'slug'           => 'intek-akuakultur',
                'name'           => 'Intek Akuakultur',
                'name_en'        => 'Intek Akuakultur',
                'indexing'       => 'Google Scholar / Garuda / Moraref',
                'issn'           => 'e-ISSN: 2579-6291',
                'description'    => 'Jurnal telaah sejawat yang dikelola Program Studi Budidaya Perairan, FIKP UMRAH. Memuat artikel ilmiah teknologi budidaya laut tropis, rekayasa pembenihan biota laut, pakan maritim, dan kesehatan lingkungan perairan.',
                'description_en' => 'Peer-reviewed journal managed by Aquaculture Department, FIKP UMRAH. Publishes empirical investigations on tropical marine aquaculture, hatchery technology, marine feed formulation, and aquatic health.',
                'frequency'      => 'Terbit 2x Setahun',
                'frequency_en'   => 'Biannual Publication',
                'journal_url'    => 'https://ojs.umrah.ac.id/index.php/intek',
                'cover_image'    => null,
                'order_num'      => 4,
                'is_active'      => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ];

        foreach ($journals as $journal) {
            $existing = $db->table('jurnal_ilmiah')->where('slug', $journal['slug'])->get()->getRow();
            if ($existing) {
                $db->table('jurnal_ilmiah')->where('slug', $journal['slug'])->update($journal);
            } else {
                $db->table('jurnal_ilmiah')->insert($journal);
            }
        }
    }
}
