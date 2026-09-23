<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        // Check for customized profile data overrides from Admin CMS
        $customProfile = null;
        $profileFile = WRITEPATH . 'site_profile.json';
        if (file_exists($profileFile)) {
            $customProfile = json_decode(file_get_contents($profileFile), true);
        }

        // Load Researchers from Database with fallback
        $penelitiModel = new \App\Models\PenelitiModel();
        
        $dbPimpinan = $penelitiModel->getByCategory('pimpinan');
        $researchers = [];
        foreach ($dbPimpinan as $p) {
            $researchers[] = [
                'name'   => $p['name'],
                'role'   => $isEn ? ($p['role_en'] ?: $p['role']) : $p['role'],
                'focus'  => $isEn ? ($p['focus_en'] ?: $p['focus']) : $p['focus'],
                'nip'    => $p['nip'] ?? '',
                'scopus' => $p['scopus'] ?? '',
                'email'  => $p['email'],
                'image'  => !empty($p['image']) ? base_url($p['image']) : base_url('images/peneliti_atika.jpg'),
            ];
        }

        $dbDewan = $penelitiModel->getByCategory('dewan_peneliti');
        $researchMembers = [];
        $gradients = [
            'linear-gradient(135deg, #1d4ed8, #06b6d4)',
            'linear-gradient(135deg, #b45309, #f59e0b)',
            'linear-gradient(135deg, #4338ca, #818cf8)',
            'linear-gradient(135deg, #0f172a, #475569)',
            'linear-gradient(135deg, #0f766e, #10b981)',
            'linear-gradient(135deg, #0284c7, #38bdf8)',
            'linear-gradient(135deg, #d97706, #fbbf24)',
            'linear-gradient(135deg, #059669, #10b981)',
            'linear-gradient(135deg, #1e293b, #64748b)',
            'linear-gradient(135deg, #047857, #34d399)'
        ];
        foreach ($dbDewan as $idx => $m) {
            $parts = explode(' ', trim(str_replace(['Dr.', 'Dra.', 'S.Pd.', 'M.Sc.', 'M.A.', 'S.H.', 'S.Sos.', 'IMAS', 'S.Kel.', 'M.Si.', 'S.T.', 'M.T.', 'S.IP.', 'M.Hub.Int.', 'S.Pi.', ','], '', $m['name'])));
            $initials = '';
            foreach (array_slice(array_filter($parts), 0, 2) as $pt) {
                $initials .= mb_strtoupper(mb_substr($pt, 0, 1));
            }
            if (empty($initials)) {
                $initials = 'NN';
            }

            $researchMembers[] = [
                'name'        => $m['name'],
                'role'        => $isEn ? ($m['role_en'] ?: $m['role']) : $m['role'],
                'faculty'     => $isEn ? ($m['faculty_en'] ?: $m['faculty']) : $m['faculty'],
                'focus'       => $isEn ? ($m['focus_en'] ?: $m['focus']) : $m['focus'],
                'email'       => $m['email'],
                'cluster'     => $m['cluster'] ?? '-',
                'initials'    => $initials,
                'bg_gradient' => $gradients[$idx % count($gradients)],
            ];
        }

        // Peneliti Eksternal & Mitra Riset (External Research Fellows)
        $dbEksternal = $penelitiModel->getByCategory('eksternal');
        if (empty($dbEksternal)) {
            $dbEksternal = [
                [
                    'name'        => 'Dr. Joshua Gebert',
                    'role'        => 'Peneliti Eksternal / Visiting Scholar',
                    'role_en'     => 'External Research Fellow / Visiting Scholar',
                    'faculty'     => 'Climate Transformation Programme (CTP) / Nanyang Technological University (NTU)',
                    'faculty_en'  => 'Climate Transformation Programme (CTP) / Nanyang Technological University (NTU)',
                    'focus'       => 'Urban Planning dan Spatial Analysis Fokus Climate Transformation',
                    'focus_en'    => 'Urban Planning & Spatial Analysis focused on Climate Transformation',
                    'email'       => 'joshua.gebert@ntu.edu.sg',
                    'cluster'     => $isEn ? 'Urban Planning & Climate Transformation' : 'Perencanaan Wilayah & Transformasi Iklim',
                ],
            ];
        }

        $externalResearchers = [];
        foreach ($dbEksternal as $idx => $em) {
            $parts = explode(' ', trim(str_replace(['Dr.', 'Prof.', ','], '', $em['name'])));
            $initials = '';
            foreach (array_slice(array_filter($parts), 0, 2) as $pt) {
                $initials .= mb_strtoupper(mb_substr($pt, 0, 1));
            }

            $externalResearchers[] = [
                'name'        => $em['name'],
                'role'        => $isEn ? (($em['role_en'] ?? null) ?: $em['role']) : $em['role'],
                'faculty'     => $isEn ? (($em['faculty_en'] ?? null) ?: $em['faculty']) : $em['faculty'],
                'focus'       => $isEn ? (($em['focus_en'] ?? null) ?: $em['focus']) : $em['focus'],
                'email'       => $em['email'],
                'cluster'     => $em['cluster'] ?? '-',
                'initials'    => $initials ?: 'JG',
                'bg_gradient' => 'linear-gradient(135deg, #0284c7, #0d9488)',
            ];
        }

        $data = [
            'title'                => $isEn ? 'Profile & Research Fellows - North Natuna Sea Research Center UMRAH' : 'Profil & Personalia - Pusat Studi Laut Natuna Utara UMRAH',
            'researchers'          => $researchers,
            'research_members'     => $researchMembers,
            'external_researchers' => $externalResearchers,
            'customProfile'        => $customProfile,
        ];

        return view('pages/profil', $data);
    }
}
