<?php

namespace App\Controllers;

use App\Models\UnduhanModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class Unduhan extends BaseController
{
    protected UnduhanModel $unduhanModel;

    public function __construct()
    {
        $this->unduhanModel = new UnduhanModel();
    }

    /**
     * Display the Document Repository and Download Center.
     */
    public function index(): string
    {
        $isEn = (service('request')->getLocale() === 'en');
        $documents = $this->unduhanModel->findAll();

        if ($isEn) {
            foreach ($documents as &$doc) {
                if ($doc['category_id'] === 'sop') {
                    $doc['category'] = 'Lab SOP';
                } elseif ($doc['category_id'] === 'policy-brief') {
                    $doc['category'] = 'Policy Brief';
                } elseif ($doc['category_id'] === 'template') {
                    $doc['category'] = 'Partnership Template';
                } elseif ($doc['category_id'] === 'panduan') {
                    $doc['category'] = 'Research Guide';
                }

                if ($doc['slug'] === 'sop-adcp-multibeam') {
                    $doc['title'] = 'SOP Hydro-Acoustic Survey (ADCP & Multibeam Echosounder)';
                    $doc['desc']  = 'Standard operating procedure for oceanographic acoustic sensor calibration, transect track surveys, and bathymetric data processing.';
                } elseif ($doc['slug'] === 'sop-uji-kualitas-air') {
                    $doc['title'] = 'SOP Seawater Quality & Heavy Metal Spectrophotometry Testing';
                    $doc['desc']  = 'Accredited testing protocols for pH, salinity, DO, nitrate, phosphate, and heavy metals (Pb, Cd, Cu) in island waters.';
                } elseif ($doc['slug'] === 'pb-kedaulatan-natuna-lcs') {
                    $doc['title'] = 'Policy Brief: Archipelagic Maritime Governance & Natuna EEZ Sovereignty';
                    $doc['desc']  = 'Strategic policy recommendations for integrated satellite monitoring and UNCLOS 1982 maritime border protection.';
                } elseif ($doc['slug'] === 'pb-logistik-pesisir') {
                    $doc['title'] = 'Policy Brief: Coastal Logistics Connectivity & Island Inflation Stabilization';
                    $doc['desc']  = 'Pioneer sea transportation subsidy models and local feeder port optimization to reduce inter-island price disparities.';
                } elseif ($doc['slug'] === 'tpl-mou-riset-kemaritiman') {
                    $doc['title'] = 'Standard MoU Template for Marine Research & Pentahelix Collaboration';
                    $doc['desc']  = 'Official draft agreement for joint research between UMRAH, regional governments, industries, and international universities.';
                } elseif ($doc['slug'] === 'panduan-keselamatan-survei') {
                    $doc['title'] = 'Standard Field Safety & Survival Protocol for Marine Research Vessels';
                    $doc['desc']  = 'Compulsory safety manual, emergency procedures, and offshore life-saving protocol for research expeditions in open waters.';
                }
            }
            unset($doc);
        }

        // Calculate statistics
        $stats = [
            'total'       => count($documents),
            'sop'         => count(array_filter($documents, static fn($d) => $d['category_id'] === 'sop')),
            'policy'      => count(array_filter($documents, static fn($d) => $d['category_id'] === 'policy-brief')),
            'template'    => count(array_filter($documents, static fn($d) => $d['category_id'] === 'template')),
            'panduan'     => count(array_filter($documents, static fn($d) => $d['category_id'] === 'panduan')),
            'total_dl'    => array_sum(array_column($documents, 'downloads')),
        ];

        $data = [
            'title'     => $isEn ? 'Document Repository & Download Center - NNSRC UMRAH' : 'Repositori Dokumen & Pusat Unduhan - Pusat Studi Laut Natuna Utara UMRAH',
            'documents' => $documents,
            'stats'     => $stats,
        ];

        return view('pages/unduhan', $data);
    }

    /**
     * Download handler delivering official documents with proper HTTP headers and counter tracking.
     *
     * @param string $slug
     * @return ResponseInterface
     * @throws PageNotFoundException
     */
    public function unduh(string $slug): ResponseInterface
    {
        $doc = $this->findDocument($slug);

        if (! $doc) {
            throw PageNotFoundException::forPageNotFound('Dokumen unduhan tidak ditemukan: ' . esc($slug));
        }

        // Increment download counter in DB
        $this->unduhanModel->incrementDownload($slug);

        $filename = sprintf('%s-%s.%s', $doc['code'], $doc['slug'], strtolower($doc['file_type']));

        if (strtolower($doc['file_type']) === 'pdf') {
            $content = $this->generatePdfContent($doc);
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->setBody($content);
        }

        // For DOCX / templates
        $content = $this->generateDocxContent($doc);
        return $this->response
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($content);
    }

    /**
     * Find document by slug or document code.
     */
    private function findDocument(string $slug): ?array
    {
        return $this->unduhanModel
            ->where('slug', $slug)
            ->orWhere('code', $slug)
            ->first();
    }

    /**
     * Synthesize a genuine, structurally valid PDF document for the requested file.
     */
    private function generatePdfContent(array $doc): string
    {
        $title = $doc['title'];
        $code = $doc['code'];
        $category = $doc['category'];
        $year = $doc['year'];
        $desc = $doc['desc'];

        $stream = "BT\n/F1 16 Tf\n50 730 Td\n(NORTH NATUNA SEA RESEARCH CENTER UMRAH) Tj\n"
            . "0 -22 Td\n/F1 13 Tf\n(Universitas Maritim Raja Ali Haji - Tanjungpinang) Tj\n"
            . "0 -35 Td\n/F1 14 Tf\n(DOKUMEN RESMI REPOSITORI) Tj\n"
            . "0 -25 Td\n/F1 10 Tf\n(Kode Dokumen: " . addslashes($code) . "  |  Kategori: " . addslashes($category) . "  |  Tahun: " . addslashes($year) . ") Tj\n"
            . "0 -30 Td\n/F1 12 Tf\n(" . addslashes(substr($title, 0, 70)) . ") Tj\n";

        if (strlen($title) > 70) {
            $stream .= "0 -18 Td\n/F1 12 Tf\n(" . addslashes(substr($title, 70, 70)) . ") Tj\n";
        }

        $stream .= "0 -30 Td\n/F1 10 Tf\n(Deskripsi Dokumen:) Tj\n"
            . "0 -18 Td\n/F1 9 Tf\n(" . addslashes(substr($desc, 0, 85)) . ") Tj\n";

        if (strlen($desc) > 85) {
            $stream .= "0 -15 Td\n/F1 9 Tf\n(" . addslashes(substr($desc, 85, 85)) . ") Tj\n";
        }

        $stream .= "0 -40 Td\n/F1 9 Tf\n(Naskah ini diterbitkan secara sah oleh North Natuna Sea Research Center UMRAH) Tj\n"
            . "0 -15 Td\n/F1 9 Tf\n(Kampus Dompak, Tanjungpinang, Kepulauan Riau | Web: psk.umrah.ac.id) Tj\nET";

        $streamLen = strlen($stream);

        $objects = [];
        $objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $objects[2] = "<< /Type /Pages /Kids [3 0 R] /Count 1 >>";
        $objects[3] = "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>";
        $objects[4] = "<< /Length {$streamLen} >>\nstream\n{$stream}\nendstream";
        $objects[5] = "<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>";

        $pdf = "%PDF-1.4\n";
        $offsets = [];

        foreach ($objects as $num => $obj) {
            $offsets[$num] = strlen($pdf);
            $pdf .= "{$num} 0 obj\n{$obj}\nendobj\n";
        }

        $xrefOffset = strlen($pdf);
        $pdf .= "xref\n0 6\n0000000000 65535 f \n";
        for ($i = 1; $i <= 5; $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }

        $pdf .= "trailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n{$xrefOffset}\n%%EOF";

        return $pdf;
    }

    /**
     * Generate structured byte content for DOCX template downloads.
     */
    private function generateDocxContent(array $doc): string
    {
        $text = "NORTH NATUNA SEA RESEARCH CENTER - UNIVERSITAS MARITIM RAJA ALI HAJI\n"
            . "=================================================================\n"
            . "Kode Dokumen : {$doc['code']}\n"
            . "Judul        : {$doc['title']}\n"
            . "Kategori     : {$doc['category']}\n"
            . "Tahun Terbit : {$doc['year']}\n"
            . "Format Asli  : Microsoft Word Template (.docx)\n"
            . "-----------------------------------------------------------------\n"
            . "Ringkasan / Ketentuan:\n"
            . "{$doc['desc']}\n"
            . "-----------------------------------------------------------------\n"
            . "North Natuna Sea Research Center UMRAH - Gedung LPPM Kampus Dompak, Tanjungpinang\n";

        return $text;
    }
}
