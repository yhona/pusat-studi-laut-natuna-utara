<?php

namespace App\Controllers;

use App\Models\KontakPesanModel;

class Kontak extends BaseController
{
    protected KontakPesanModel $kontakModel;

    public function __construct()
    {
        $this->kontakModel = new KontakPesanModel();
    }

    public function index(): string
    {
        $isEn = (service('request')->getLocale() === 'en');
        $data = [
            'title'   => $isEn ? 'Contact & Research Partnerships - NNSRC UMRAH' : 'Kontak & Kerjasama Riset - Pusat Studi Laut Natuna Utara UMRAH',
            'success' => session()->getFlashdata('success'),
            'error'   => session()->getFlashdata('error'),
        ];

        return view('pages/kontak', $data);
    }

    public function kirim()
    {
        $isEn = (service('request')->getLocale() === 'en');

        $postData = [
            'nama'       => trim($this->request->getPost('nama') ?? ''),
            'instansi'   => trim($this->request->getPost('instansi') ?? ''),
            'email'      => trim($this->request->getPost('email') ?? ''),
            'telepon'    => trim($this->request->getPost('telepon') ?? ''),
            'kategori'   => trim($this->request->getPost('kategori') ?? ''),
            'pesan'      => trim($this->request->getPost('pesan') ?? ''),
            'status'     => 'baru',
            'ip_address' => $this->request->getIPAddress(),
        ];

        if (! $this->kontakModel->save($postData)) {
            $errMsg = $isEn 
                ? 'Failed to send message. Please check that all required fields are correctly completed.'
                : 'Gagal mengirim pesan. Silakan periksa kembali kelengkapan data Anda.';

            return redirect()->to(base_url('kontak#kerjasama'))
                ->withInput()
                ->with('error', $errMsg);
        }

        $succMsg = $isEn
            ? 'Your partnership inquiry has been successfully submitted to the NNSRC UMRAH Secretariat. Our team will contact you shortly.'
            : 'Pesan / pengajuan kerjasama Anda telah berhasil dikirimkan ke Sekretariat Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH. Tim kami akan segera menghubungi Anda.';

        return redirect()->to(base_url('kontak'))
            ->with('success', $succMsg);
    }
}
