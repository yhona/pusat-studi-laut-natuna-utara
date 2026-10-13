<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SambutanBsklnSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // 1. Ensure existing Koordinator Pusat Studi row has role_key='koordinator' and order_seq=3
        $existing = $db->table('sambutan_pimpinan')->where('id', 1)->get()->getRowArray();
        if ($existing) {
            $db->table('sambutan_pimpinan')->where('id', 1)->update([
                'role_key'   => 'koordinator',
                'order_seq'  => 3,
                'updated_at' => $now,
            ]);
        }

        // 2. Insert or update Sambutan Kepala BSKLN Kemlu RI (order_seq = 1)
        $bskln = $db->table('sambutan_pimpinan')->where('role_key', 'bskln')->get()->getRowArray();

        $contentId = "Saya sebagai Kepala BSKLN mengucapkan selamat kepada Universitas Maritim Raja Ali Haji atas pembentukan Pusat Studi Laut Natuna Utara sebagai wadah riset kemaritiman yang memperkuat poros kemaritiman nasional Indonesia, Pusat Studi ini bertugas untuk memperkarsasi kerjasama dengan stakeholder kemaritiman internasional dan nasional.\n\nTugas ini diakui tidak mudah, sehingga sebagai Kepala BSKLN saya memberikan encouragement untuk fokus memperkaya informasi yang terdepan dalam situs pusat studi ini.\n\nKredibilitas informasi maupun program dan kegiatan yang dimuat dalam website Pusat Studi Laut Natuna Utara akan sangat membantu outreach dan kredibilitas Pusat Studi ini.\n\nSekali lagi saya mengucapkan selamat kepada Universitas Maritim Raja Ali Haji yang telah merintis Pusat Studi ini dan sekaligus membuat situs informasi yang diperlukan. Semoga upaya ini dapat membuat Pusat Studi Laut Natuna Utara semakin aktif dalam mengaktualisasikan misi riset kemaritiman, terima kasih.";

        $contentEn = "As the Head of BSKLN, I extend my warmest congratulations to Universitas Maritim Raja Ali Haji on the establishment of the North Natuna Sea Research Center as a dedicated maritime research hub that strengthens Indonesia's national maritime axis. This Research Center is mandated to initiate partnerships with international and national maritime stakeholders.\n\nThis task is recognized as challenging; therefore, as Head of BSKLN, I offer my strong encouragement to focus on enriching cutting-edge, authoritative information on this research center's portal. The credibility of the information, programs, and activities published on the North Natuna Sea Research Center website will substantially bolster the outreach and credibility of this Center.\n\nOnce again, I congratulate Universitas Maritim Raja Ali Haji for pioneering this Research Center and simultaneously developing this essential informational platform. May this endeavor empower the North Natuna Sea Research Center to become ever more active in actualizing its maritime research mission. Thank you.";

        $bsklnData = [
            'name'       => 'Dr. Yayan G.H. Mulyana',
            'title'      => 'Kepala Badan Strategi Kebijakan Luar Negeri (BSKLN) Kementerian Luar Negeri RI',
            'title_en'   => 'Head of Foreign Policy Strategy Agency (BSKLN), Ministry of Foreign Affairs of Indonesia',
            'heading'    => 'Sambutan Kepala BSKLN Kementerian Luar Negeri: Penguatan Riset Kemaritiman Nasional',
            'heading_en' => 'Remarks by Head of BSKLN MoFA: Reinforcing Indonesia\'s Maritime Research Fulcrum',
            'quote'      => '"Pusat Studi ini bertugas untuk memperkarsai kerjasama dengan stakeholder kemaritiman internasional dan nasional guna memperkuat poros kemaritiman nasional Indonesia."',
            'quote_en'   => '"This Center is mandated to initiate strategic collaborations with international and national maritime stakeholders to reinforce Indonesia\'s national maritime axis."',
            'content'    => $contentId,
            'content_en' => $contentEn,
            'image'      => 'images/kepala_bskln.jpg',
            'is_active'  => 1,
            'role_key'   => 'bskln',
            'order_seq'  => 1,
            'updated_at' => $now,
        ];

        if ($bskln) {
            $db->table('sambutan_pimpinan')->where('id', $bskln['id'])->update($bsklnData);
        } else {
            $bsklnData['created_at'] = $now;
            $db->table('sambutan_pimpinan')->insert($bsklnData);
        }
    }
}
