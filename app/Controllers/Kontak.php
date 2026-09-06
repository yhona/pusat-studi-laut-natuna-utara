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
        $data = [
            'title'   => 'Kontak & Kerjasama Riset - Pusat Studi Laut Natuna Utara UMRAH',
            'success' => session()->getFlashdata('success'),
            'error'   => session()->getFlashdata('error'),
        ];

        return view('pages/kontak', $data);
    }

    public function kirim()
    {
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
            return redirect()->to(base_url('kontak#kerjasama'))
                ->withInput()
                ->with('error', 'Gagal mengirim pesan. Silakan periksa kembali kelengkapan data Anda.');
        }

        return redirect()->to(base_url('kontak'))
            ->with('success', 'Pesan / pengajuan kerjasama Anda telah berhasil dikirimkan ke Sekretariat Pusat Studi Laut Natuna Utara (North Natuna Sea Research Center) UMRAH. Tim kami akan segera menghubungi Anda.');
    }
}
