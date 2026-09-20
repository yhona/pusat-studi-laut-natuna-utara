<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
        $messages = $this->kontakModel->orderBy('id', 'DESC')->findAll();

        $data = [
            'title'    => 'Pesan Kerjasama & Kontak Masuk - Admin NNSRC',
            'messages' => $messages,
        ];

        return view('admin/kontak/index', $data);
    }

    public function updateStatus(int $id)
    {
        $status = trim((string) $this->request->getPost('status'));
        $this->kontakModel->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Status pesan berhasil diperbarui.');
    }
}
