<?php

namespace App\Controllers;

class Layanan extends BaseController
{
    public function index(): string
    {
        $locale = service('request')->getLocale();
        $isEn = ($locale === 'en');

        $layananModel = new \App\Models\LayananKonsultasiModel();
        $dbServices = $layananModel->where('is_active', 1)->orderBy('order_num', 'ASC')->findAll();

        $services = [];
        if (!empty($dbServices)) {
            foreach ($dbServices as $item) {
                $rawInst = is_array($item['instruments']) ? $item['instruments'] : (json_decode($item['instruments'] ?? '[]', true) ?: []);
                $rawDel  = is_array($item['deliverables']) ? $item['deliverables'] : (json_decode($item['deliverables'] ?? '[]', true) ?: []);

                $specInstruments = [];
                if (is_array($rawInst)) {
                    foreach ($rawInst as $inst) {
                        if (is_array($inst) && isset($inst['name'])) {
                            $specInstruments[] = $inst;
                        } else {
                            $parts = explode(':', (string)$inst, 2);
                            $name = trim($parts[0]);
                            $param = isset($parts[1]) ? trim($parts[1]) : $name;
                            $specInstruments[] = ['name' => $name, 'param' => $param];
                        }
                    }
                }

                $services[] = [
                    'id'          => $item['slug'],
                    'icon'        => $item['icon'] ?? 'fa-anchor',
                    'title'       => ($isEn && !empty($item['title_en'])) ? $item['title_en'] : $item['title'],
                    'desc'        => ($isEn && !empty($item['desc_en'])) ? $item['desc_en'] : $item['desc'],
                    'instruments' => is_array($rawInst) ? $rawInst : [],
                    'deliverables'=> is_array($rawDel) ? $rawDel : [],
                    'spec'        => [
                        'code'        => $item['code'] ?? 'SOP-NNSRC-01',
                        'standards'   => $item['standards'] ?? ($isEn ? 'National & International Maritime Standards' : 'Pedoman & Standar Regulasi Maritim Nasional'),
                        'sopName'     => $item['sop_name'] ?? ($isEn ? 'Standard Operating Procedure' : 'Standar Operasional Prosedur'),
                        'sopSlug'     => 'sop-oseanografi',
                        'instruments' => $specInstruments,
                        'deliverables'=> is_array($rawDel) ? $rawDel : []
                    ]
                ];
            }
        }

        $data = [
            'title'    => $isEn ? 'Services & Laboratories - NNSRC UMRAH' : 'Layanan & Jasa Konsultasi Kemaritiman - UMRAH',
            'services' => $services
        ];

        return view('pages/layanan', $data);
    }
}
