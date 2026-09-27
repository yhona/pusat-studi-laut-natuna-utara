<?php

namespace App\Controllers;

class Publikasi extends BaseController
{
    public function index(): string
    {
        $isEn = (service('request')->getLocale() === 'en');

        $briefModel = new \App\Models\PublikasiBriefModel();
        $dbBriefs = $briefModel->where('is_published', 1)->orderBy('year', 'DESC')->findAll();

        $defaultBriefs = [];
        if (!empty($dbBriefs)) {
            foreach ($dbBriefs as $b) {
                $defaultBriefs[] = [
                    'id'        => $b['id'],
                    'number'    => $b['number'],
                    'title'     => ($isEn && !empty($b['title_en'])) ? $b['title_en'] : $b['title'],
                    'year'      => $b['year'],
                    'author'    => ($isEn && !empty($b['author_en'])) ? $b['author_en'] : $b['author'],
                    'desc'      => ($isEn && !empty($b['desc_en'])) ? $b['desc_en'] : $b['desc'],
                    'file'      => !empty($b['file_path']) ? base_url($b['file_path']) : '#',
                ];
            }
        }

        // Dynamic Scientific Journals
        $journals = [];
        try {
            $jurnalModel = new \App\Models\JurnalIlmiahModel();
            $rawJournals = $jurnalModel->where('is_active', 1)
                                       ->orderBy('order_num', 'ASC')
                                       ->orderBy('id', 'ASC')
                                       ->findAll();
            foreach ($rawJournals as $j) {
                $journals[] = [
                    'name'      => ($isEn && ! empty($j['name_en'])) ? $j['name_en'] : $j['name'],
                    'indexing'  => $j['indexing'],
                    'issn'      => $j['issn'],
                    'desc'      => ($isEn && ! empty($j['description_en'])) ? $j['description_en'] : $j['description'],
                    'link'      => $j['journal_url'],
                    'frequency' => ($isEn && ! empty($j['frequency_en'])) ? $j['frequency_en'] : ($j['frequency'] ?? ($isEn ? 'Biannual Publication' : 'Terbit 2x Setahun')),
                    'cover'     => $j['cover_image'] ?? null,
                ];
            }
        } catch (\Throwable $e) {
            $journals = [];
        }

        $data = [
            'title'         => $isEn ? 'Publications & Maritime Policy Briefs - UMRAH' : 'Publikasi & Policy Brief Kemaritiman - UMRAH',
            'policy_briefs' => $defaultBriefs,
            'journals'      => $journals,
        ];

        return view('pages/publikasi', $data);
    }
}
