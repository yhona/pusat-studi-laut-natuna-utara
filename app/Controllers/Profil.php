<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        // Executive leadership (5 pimpinan inti)
        $researchers = [
            [
                'name'     => 'Dr. Atika Thahira, S.H., M.H.',
                'role'     => $isEn ? 'Center Coordinator' : 'Koordinator Pusat Studi / Center Coordinator',
                'focus'    => $isEn ? 'Maritime Law & Environmental Law' : 'Hukum Maritim dan Hukum Lingkungan',
                'nip'      => '19820714 200812 2 003',
                'scopus'   => 'Scopus ID: 58164669100',
                'email'    => 'atika.thahira@umrah.ac.id',
                'image'    => base_url('images/peneliti_atika.jpg')
            ],
            [
                'name'     => 'Dr. Ady Muzwardi, S.IP., M.A., M.H.I.',
                'role'     => 'Head of Research Department',
                'focus'    => $isEn ? 'International Relations, Maritime Logistics & Connectivity' : 'Hubungan Internasional, Logistik dan Konektivitas Maritim',
                'nip'      => '19810410 200604 1 002',
                'scopus'   => 'Scopus ID: 57727069200',
                'email'    => 'ady.muzwardi@umrah.ac.id',
                'image'    => base_url('images/peneliti_ady.jpg')
            ],
            [
                'name'     => 'Rachma Indriyani, S.H., LL.M., Ph.D.',
                'role'     => 'Vice of Research Department',
                'focus'    => 'International Law, Ocean and Law of the Sea, Space Law, Maritime and Fisheries',
                'nip'      => '19861118 201212 2 001',
                'scopus'   => 'Scopus ID: 57223868958',
                'email'    => 'rachmaindriyani@staff.uns.ac.id',
                'image'    => base_url('images/peneliti_rachma.jpg')
            ],
            [
                'name'     => 'Euis Ammelia, S.IP., M.I.P.',
                'role'     => 'Secretary of Research Center',
                'focus'    => $isEn ? 'International Politics & Local Governance' : 'Politik Internasional dan Pemerintahan Lokal',
                'nip'      => '19890512 201803 2 001',
                'scopus'   => 'SINTA ID: 6909581',
                'email'    => 'euis.ammelia@umrah.ac.id',
                'image'    => base_url('images/peneliti_euis.jpg')
            ],
            [
                'name'     => 'Dedy Afrizal, S.Sos., M.Si., Ph.D.',
                'role'     => 'Head of the Community Service Department',
                'focus'    => 'Digital Governance, Maritime and Archipelagic',
                'nip'      => '19780824 200501 1 003',
                'scopus'   => 'Scopus ID: 57222904882',
                'email'    => 'dedy.afrizal@umrah.ac.id',
                'image'    => base_url('images/peneliti_dedy.jpg')
            ],
        ];

        // 10 Anggota Dewan Peneliti (Research Fellows)
        $researchMembers = [
            [
                'name'        => 'Karla Amelia, S.Pd., M.Sc.',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Marine Sciences & Fisheries (FIKP) UMRAH' : 'Fakultas Ilmu Kelautan & Perikanan (FIKP) UMRAH',
                'focus'       => $isEn ? 'Planktology, Marine Water Quality, Marine Biology & Coastal Conservation' : 'Planktologi, Kualitas Air Laut, Biologi Kelautan & Konservasi Pesisir',
                'email'       => 'karla.amelia@umrah.ac.id',
                'cluster'     => $isEn ? 'Marine Ecology & Biological Resources' : 'Ekologi & Sumber Daya Hayati Laut',
                'initials'    => 'KA',
                'bg_gradient' => 'linear-gradient(135deg, #1d4ed8, #06b6d4)'
            ],
            [
                'name'        => 'Dr. Dra. Anastasia Wiwik Swastiwi, M.A.',
                'role'        => $isEn ? 'Research Fellow / Maritime Historian' : 'Anggota Dewan Peneliti / Sejarawan Maritim',
                'faculty'     => $isEn ? 'Faculty of Social & Political Sciences (FISIP) UMRAH' : 'Fakultas Ilmu Sosial & Ilmu Politik (FISIP) UMRAH',
                'focus'       => $isEn ? 'Malay Maritime History, Border Oceanic Civilization, Culture & ASEAN Regional Diplomacy' : 'Sejarah Maritim Melayu, Peradaban Bahari Perbatasan, Budaya & Diplomasi Kawasan ASEAN',
                'email'       => 'anastasia.wiwik@umrah.ac.id',
                'cluster'     => $isEn ? 'Border Maritime History & Culture' : 'Sejarah & Budaya Bahari Perbatasan',
                'initials'    => 'AW',
                'bg_gradient' => 'linear-gradient(135deg, #b45309, #f59e0b)'
            ],
            [
                'name'        => 'Dr. Siti Arieta, S.H., M.A.',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Social & Political Sciences (FISIP) UMRAH' : 'Fakultas Ilmu Sosial & Ilmu Politik (FISIP) UMRAH',
                'focus'       => $isEn ? 'Marine Environmental Sociology, Coastal Customary Law & Border Fisheries Social Dynamics' : 'Sosiologi Lingkungan Maritim, Hukum Adat Pesisir & Dinamika Sosial Nelayan Perbatasan',
                'email'       => 'siti.arieta@umrah.ac.id',
                'cluster'     => $isEn ? 'Environmental Sociology & Coastal Customary Law' : 'Sosiologi Lingkungan & Hukum Adat Pesisir',
                'initials'    => 'SA',
                'bg_gradient' => 'linear-gradient(135deg, #4338ca, #818cf8)'
            ],
            [
                'name'        => 'Dr. Sayed Fauzan Riyadi, S.Sos., IMAS',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Social & Political Sciences (FISIP) UMRAH' : 'Fakultas Ilmu Sosial & Ilmu Politik (FISIP) UMRAH',
                'focus'       => $isEn ? 'North Natuna Sea Maritime Geopolitics, Border Security & SCS Regional Governance' : 'Geopolitik Maritim Laut Natuna Utara, Keamanan Perbatasan & Tata Kelola Kawasan LCS',
                'email'       => 'sayedfauzan@umrah.ac.id',
                'cluster'     => $isEn ? 'Geopolitics & Natuna Sea Security' : 'Geopolitik & Keamanan Laut Natuna',
                'initials'    => 'SF',
                'bg_gradient' => 'linear-gradient(135deg, #0f172a, #475569)'
            ],
            [
                'name'        => 'Indah Kartika, S.Kel., M.Si.',
                'role'        => $isEn ? 'Research Fellow / Head of UMRAH SDGs Center' : 'Anggota Dewan Peneliti / Koor. SDGs Center UMRAH',
                'faculty'     => $isEn ? 'Faculty of Marine Sciences & Fisheries (FIKP) UMRAH' : 'Fakultas Ilmu Kelautan & Perikanan (FIKP) UMRAH',
                'focus'       => $isEn ? 'Tropical Marine Ecology, Blue Carbon, Mangrove Conservation & Sustainable Development (SDG 14)' : 'Ekologi Laut Tropis, Blue Carbon, Konservasi Mangrove & Pembangunan Berkelanjutan (SDG 14)',
                'email'       => 'indah.kartika@umrah.ac.id',
                'cluster'     => $isEn ? 'Maritime SDGs & Tropical Conservation' : 'SDGs Kemaritiman & Konservasi Tropis',
                'initials'    => 'IK',
                'bg_gradient' => 'linear-gradient(135deg, #0f766e, #10b981)'
            ],
            [
                'name'        => 'Aditia Ayu Rahma Nabila, S.T., M.T.',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Engineering & Maritime Technology (FTTK) UMRAH' : 'Fakultas Teknik & Teknologi Kemaritiman (FTTK) UMRAH',
                'focus'       => $isEn ? 'Marine Electric Power Systems, Coastal Instrumentation Automation & Island Microgrids' : 'Sistem Tenaga Listrik Maritim, Otomasi Instrumentasi Pesisir & Mikrogrid Kepulauan',
                'email'       => 'aditia.nabila@umrah.ac.id',
                'cluster'     => $isEn ? 'Maritime Electrical Systems & Instrumentation' : 'Instrumentasi & Tenaga Listrik Maritim',
                'initials'    => 'AN',
                'bg_gradient' => 'linear-gradient(135deg, #0284c7, #38bdf8)'
            ],
            [
                'name'        => 'Ahmad Rusdi, M.T.',
                'role'        => $isEn ? 'Cluster IV Coordinator & Research Fellow' : 'Koordinator Klaster IV & Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Engineering & Maritime Technology (FTTK) UMRAH' : 'Fakultas Teknik & Teknologi Kemaritiman (FTTK) UMRAH',
                'focus'       => $isEn ? 'Archipelagic Renewable Energy, Ocean Current Energy Conversion & Remote Island Microgrids' : 'Energi Terbarukan Kepulauan, Konversi Energi Arus Laut & Mikrogrid Pulau Terpencil',
                'email'       => 'ahmad.rusdi@umrah.ac.id',
                'cluster'     => $isEn ? 'Renewable Energy in Island Regions' : 'Energi Terbarukan di Wilayah Kepulauan',
                'initials'    => 'AR',
                'bg_gradient' => 'linear-gradient(135deg, #d97706, #fbbf24)'
            ],
            [
                'name'        => 'Rinaldo Dwi Putra, S.IP., M.Hub.Int.',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Social & Political Sciences (FISIP) UMRAH' : 'Fakultas Ilmu Sosial & Ilmu Politik (FISIP) UMRAH',
                'focus'       => $isEn ? 'Cross-Border Maritime Diplomacy, Southeast Asian Security Regimes & Regional SCS Cooperation' : 'Diplomasi Maritim Lintas Batas, Rezim Keamanan Asia Tenggara & Kerjasama Regional LCS',
                'email'       => 'rinaldo.putra@umrah.ac.id',
                'cluster'     => $isEn ? 'Maritime Diplomacy & Regional Cooperation' : 'Diplomasi Maritim & Kerjasama Kawasan',
                'initials'    => 'RP',
                'bg_gradient' => 'linear-gradient(135deg, #0e7490, #2dd4bf)'
            ],
            [
                'name'        => 'Ilhamda Fattah Kaloko, S.H., M.H.',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Law UMRAH' : 'Fakultas Hukum UMRAH',
                'focus'       => $isEn ? 'International Law, Maritime Cybersecurity, Submarine Cable Protection & Defense AI' : 'Hukum Internasional, Keamanan Siber Maritim, Perlindungan Kabel Bawah Laut & AI Pertahanan',
                'email'       => 'ilhamda.kaloko@umrah.ac.id',
                'cluster'     => $isEn ? 'International Law & Maritime Cybersecurity' : 'Hukum Internasional & Keamanan Siber Maritim',
                'initials'    => 'IF',
                'bg_gradient' => 'linear-gradient(135deg, #1e293b, #64748b)'
            ],
            [
                'name'        => 'Benny Manullang, S.Pi., M.Si.',
                'role'        => $isEn ? 'Research Fellow' : 'Anggota Dewan Peneliti',
                'faculty'     => $isEn ? 'Faculty of Marine Sciences & Fisheries (FIKP) UMRAH' : 'Fakultas Ilmu Kelautan & Perikanan (FIKP) UMRAH',
                'focus'       => $isEn ? 'Sustainable Fisheries Resources Management & Natuna Border Fishermen Socio-Economics' : 'Pemanfaatan Sumberdaya Perikanan Berkelanjutan & Sosial-Ekonomi Nelayan Perbatasan Natuna',
                'email'       => 'benny.manullang@umrah.ac.id',
                'cluster'     => $isEn ? 'Coastal Fisheries Resource Management' : 'Manajemen Sumber Daya Perikanan Pesisir',
                'initials'    => 'BM',
                'bg_gradient' => 'linear-gradient(135deg, #047857, #34d399)'
            ],
        ];

        // Peneliti Eksternal & Mitra Riset (External Research Fellows)
        $externalResearchers = [
            [
                'name'        => 'Dr. Joshua Gebert',
                'role'        => $isEn ? 'External Research Fellow / Visiting Scholar' : 'Peneliti Eksternal / Visiting Scholar',
                'faculty'     => $isEn ? 'Climate Transformation Programme (CTP) / Nanyang Technological University (NTU)' : 'Climate Transformation Programme (CTP) / Nanyang Technological University (NTU)',
                'focus'       => 'Urban Planning dan Spatial Analysis Fokus Climate Transformation',
                'email'       => 'joshua.gebert@ntu.edu.sg',
                'cluster'     => $isEn ? 'Urban Planning & Climate Transformation' : 'Perencanaan Wilayah & Transformasi Iklim',
                'initials'    => 'JG',
                'bg_gradient' => 'linear-gradient(135deg, #0284c7, #0d9488)'
            ],
        ];

        $data = [
            'title'                => $isEn ? 'Profile & Research Fellows - North Natuna Sea Research Center UMRAH' : 'Profil & Personalia - Pusat Studi Laut Natuna Utara UMRAH',
            'researchers'          => $researchers,
            'research_members'     => $researchMembers,
            'external_researchers' => $externalResearchers,
        ];

        return view('pages/profil', $data);
    }
}
