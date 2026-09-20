<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UnduhanPermohonanModel;

class Permohonan extends BaseController
{
    protected UnduhanPermohonanModel $model;

    public function __construct()
    {
        $this->model = new UnduhanPermohonanModel();
    }

    public function index(): string
    {
        $requests = $this->model->orderBy('id', 'DESC')->findAll();

        $data = [
            'title'    => 'Daftar Permohonan Unduh Naskah - Admin NNSRC',
            'requests' => $requests,
        ];

        return view('admin/permohonan/index', $data);
    }

    public function resendEmail(int $id)
    {
        $req = $this->model->find($id);
        if (! $req) {
            return redirect()->back()->with('error', 'Data permohonan tidak ditemukan.');
        }

        try {
            $email = service('email');
            $email->setTo($req['recipient_email'] ?? 'atika.thahira@umrah.ac.id');
            $email->setCC('atika.thahira@umrah.ac.id');
            $email->setFrom('no-reply@umrah.ac.id', 'Pusat Studi Laut Natuna Utara UMRAH');
            $email->setSubject('[Kirim Ulang] Permohonan Unduh: ' . $req['document_title']);
            $email->setMessage(
                "Pemberitahuan kirim ulang data permohonan unduh dokumen.\n"
                . "Dokumen: {$req['document_title']}\n"
                . "Pemohon: {$req['applicant_name']} ({$req['applicant_institution']})\n"
                . "Email: {$req['applicant_email']}\n"
                . "No HP: {$req['applicant_phone']}\n"
                . "Keperluan: {$req['purpose']}\n"
            );
            @$email->send(false);
            $this->model->update($id, ['email_status' => 'sent']);

            return redirect()->back()->with('success', 'Email notifikasi berhasil dikirimkan ulang ke ' . esc($req['recipient_email']));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal mengirim email: ' . esc($e->getMessage()));
        }
    }

    public function delete(int $id)
    {
        $this->model->delete($id);
        return redirect()->back()->with('success', 'Data permohonan berhasil dihapus.');
    }
}
