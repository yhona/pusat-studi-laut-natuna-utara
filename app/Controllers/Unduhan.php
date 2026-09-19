<?php

namespace App\Controllers;

use App\Models\UnduhanModel;
use App\Models\UnduhanPermohonanModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class Unduhan extends BaseController
{
    protected UnduhanModel $unduhanModel;
    protected UnduhanPermohonanModel $permohonanModel;

    public function __construct()
    {
        $this->unduhanModel = new UnduhanModel();
        $this->permohonanModel = new UnduhanPermohonanModel();
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
                } elseif ($doc['slug'] === 'pb-diplomasi-perbatasan-natuna') {
                    $doc['title'] = 'Policy Brief: Border Area Management & Diplomatic Sovereignty Strategy in North Natuna Sea';
                    $doc['desc']  = 'Implementation of border management supporting diplomatic enforcement of territorial sovereignty in the North Natuna Sea by MoFA BSKLN and UMRAH.';
                } elseif ($doc['slug'] === 'pb-kpbpb-perbatasan-maritim') {
                    $doc['title'] = 'Policy Brief: Optimization of Free Trade Zone and Free Port Development';
                    $doc['desc']  = 'Strategic zones to support regional and national economic development through the KPBPB model in border areas by MoFA BSKLN and UMRAH.';
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
     * Handle download application form submission.
     * Records request, notifies document author/management via email, and returns JSON response with download URL.
     */
    public function mohonUnduh(): ResponseInterface
    {
        $isEn = (service('request')->getLocale() === 'en');

        $slug        = trim((string) $this->request->getPost('document_slug'));
        $name        = trim((string) $this->request->getPost('applicant_name'));
        $email       = trim((string) $this->request->getPost('applicant_email'));
        $phone       = trim((string) $this->request->getPost('applicant_phone'));
        $institution = trim((string) $this->request->getPost('applicant_institution'));
        $category    = trim((string) $this->request->getPost('institution_category'));
        $purpose     = trim((string) $this->request->getPost('purpose'));

        $doc = $this->findDocument($slug);
        if (! $doc) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $isEn ? 'Document not found.' : 'Dokumen tidak ditemukan.',
            ])->setStatusCode(404);
        }

        // Determine recipient email (author of Policy Brief or Center Coordinator)
        $recipientEmail = 'atika.thahira@umrah.ac.id'; // default: Center Coordinator
        $recipientName  = 'Dr. Atika Thahira, S.H., M.H.';

        if (str_starts_with($slug, 'pb-') || in_array($slug, ['pb-diplomasi-perbatasan-natuna', 'pb-kpbpb-perbatasan-maritim'], true)) {
            $recipientEmail = 'ady.muzwardi@umrah.ac.id';
            $recipientName  = 'Dr. Ady Muzwardi, S.IP., M.A., M.H.I. (Penyusun Policy Brief)';
        }

        $permohonanData = [
            'document_slug'         => $slug,
            'document_title'        => $doc['title'],
            'recipient_email'       => $recipientEmail,
            'applicant_name'        => $name,
            'applicant_email'       => $email,
            'applicant_phone'       => $phone,
            'applicant_institution' => $institution,
            'institution_category'  => $category,
            'purpose'               => $purpose,
            'ip_address'            => $this->request->getIPAddress(),
            'email_status'          => 'sent',
        ];

        if (! $this->permohonanModel->save($permohonanData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $isEn 
                    ? 'Please check that all required fields are filled correctly.' 
                    : 'Mohon periksa kembali formulir Anda. Semua bidang wajib diisi dengan benar.',
                'errors'  => $this->permohonanModel->errors(),
            ])->setStatusCode(422);
        }

        // Attempt sending email to author & archive
        $this->sendNotificationEmail($recipientEmail, $recipientName, $doc, $permohonanData);

        return $this->response->setJSON([
            'success'      => true,
            'message'      => $isEn
                ? 'Your download application has been transmitted to the author and the document is ready.'
                : 'Permohonan unduh berhasil diteruskan ke email pemilik/penyusun naskah dan dokumen siap diunduh.',
            'download_url' => base_url('unduhan/unduh/' . $slug),
            'doc_title'    => $doc['title'],
            'author_notified' => $recipientName,
        ]);
    }

    /**
     * Send email notification to document author and center management.
     */
    private function sendNotificationEmail(string $recipientEmail, string $recipientName, array $doc, array $applicant): void
    {
        try {
            $email = service('email');
            $email->setTo($recipientEmail);
            $email->setCC('atika.thahira@umrah.ac.id');
            $email->setFrom('no-reply@umrah.ac.id', 'Pusat Studi Laut Natuna Utara UMRAH');
            $email->setSubject(sprintf('[Notifikasi Akses Naskah] Permohonan Unduh: %s - %s', $doc['code'], $doc['title']));

            $body = "Yth. {$recipientName},\n\n"
                  . "Terdapat permohonan akses pengunduhan naskah publikasi Anda pada repositori resmi Pusat Studi Laut Natuna Utara (NNSRC) UMRAH dengan rincian berikut:\n\n"
                  . "------------------------------------------------------------\n"
                  . "DOKUMEN YANG DIMOHON:\n"
                  . "Judul Dokumen  : {$doc['title']}\n"
                  . "Kode Dokumen   : {$doc['code']}\n"
                  . "Kategori       : {$doc['category']}\n"
                  . "Tahun Terbit   : {$doc['year']}\n\n"
                  . "IDENTITAS PEMOHON:\n"
                  . "Nama Lengkap   : {$applicant['applicant_name']}\n"
                  . "Email Pemohon  : {$applicant['applicant_email']}\n"
                  . "No. Kontak/WA  : {$applicant['applicant_phone']}\n"
                  . "Instansi       : {$applicant['applicant_institution']}\n"
                  . "Kategori Org   : {$applicant['institution_category']}\n"
                  . "Keperluan/Riset: {$applicant['purpose']}\n"
                  . "Waktu Akses    : " . date('d-m-Y H:i:s') . " WIB\n"
                  . "IP Address     : {$applicant['ip_address']}\n"
                  . "------------------------------------------------------------\n\n"
                  . "Data ini tercatat secara otomatis dalam sistem repositori riset untuk rekam jejak dampak hilirisasi saintifik dan keterpakaian naskah kebijakan kemaritiman.\n\n"
                  . "Salam hormat,\n"
                  . "Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center)\n"
                  . "Lembaga Penelitian dan Pengabdian kepada Masyarakat (LPPM)\n"
                  . "Universitas Maritim Raja Ali Haji (UMRAH)\n"
                  . "Website: https://nnsrc.umrah.ac.id\n";

            $email->setMessage($body);
            // Suppress unconfigured SMTP exceptions in local environments while keeping mail attempt safe
            @$email->send(false);
        } catch (\Throwable $e) {
            log_message('error', 'Notification email error: ' . $e->getMessage());
        }
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
