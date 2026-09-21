<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PenelitiModel;

class Peneliti extends BaseController
{
    protected PenelitiModel $penelitiModel;

    public function __construct()
    {
        $this->penelitiModel = new PenelitiModel();
    }

    public function index(): string
    {
        $category = $this->request->getGet('category');
        $query = $this->penelitiModel->orderBy('order_num', 'ASC')->orderBy('id', 'ASC');

        if (! empty($category)) {
            $query->where('category', $category);
        }

        $peneliti = $query->findAll();

        $data = [
            'title'            => 'Kelola Personalia & Dewan Peneliti',
            'peneliti'         => $peneliti,
            'selectedCategory' => $category,
            'totalPimpinan'    => $this->penelitiModel->where('category', 'pimpinan')->countAllResults(),
            'totalDewan'       => $this->penelitiModel->where('category', 'dewan_peneliti')->countAllResults(),
            'totalEksternal'   => $this->penelitiModel->where('category', 'eksternal')->countAllResults(),
        ];

        return view('admin/peneliti/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Peneliti Baru',
        ];

        return view('admin/peneliti/create', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'role'     => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|max_length[150]',
            'category' => 'required|in_list[pimpinan,dewan_peneliti,eksternal]',
            'image'    => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = null;
        $imgFile = $this->request->getFile('image');
        if ($imgFile && $imgFile->isValid() && ! $imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/peneliti', $newName);
            $imagePath = 'uploads/peneliti/' . $newName;
        }

        $data = [
            'category'    => $this->request->getPost('category'),
            'name'        => trim($this->request->getPost('name')),
            'role'        => trim($this->request->getPost('role')),
            'role_en'     => trim($this->request->getPost('role_en') ?? ''),
            'faculty'     => trim($this->request->getPost('faculty') ?? ''),
            'faculty_en'  => trim($this->request->getPost('faculty_en') ?? ''),
            'focus'       => trim($this->request->getPost('focus') ?? ''),
            'focus_en'    => trim($this->request->getPost('focus_en') ?? ''),
            'cluster'     => trim($this->request->getPost('cluster') ?? ''),
            'nip'         => trim($this->request->getPost('nip') ?? ''),
            'scopus'      => trim($this->request->getPost('scopus') ?? ''),
            'email'       => trim($this->request->getPost('email')),
            'image'       => $imagePath,
            'order_num'   => (int) ($this->request->getPost('order_num') ?? 0),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->penelitiModel->insert($data);

        return redirect()->to(base_url('admin/peneliti'))->with('success', 'Data peneliti berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $peneliti = $this->penelitiModel->find($id);

        if (! $peneliti) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Peneliti tidak ditemukan.');
        }

        $data = [
            'title'    => 'Edit Data Peneliti: ' . $peneliti['name'],
            'peneliti' => $peneliti,
        ];

        return view('admin/peneliti/edit', $data);
    }

    public function update(int $id)
    {
        $peneliti = $this->penelitiModel->find($id);

        if (! $peneliti) {
            return redirect()->to(base_url('admin/peneliti'))->with('error', 'Peneliti tidak ditemukan.');
        }

        $rules = [
            'name'     => 'required|min_length[3]|max_length[255]',
            'role'     => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|max_length[150]',
            'category' => 'required|in_list[pimpinan,dewan_peneliti,eksternal]',
            'image'    => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $peneliti['image'];
        $imgFile = $this->request->getFile('image');
        if ($imgFile && $imgFile->isValid() && ! $imgFile->hasMoved()) {
            $newName = $imgFile->getRandomName();
            $imgFile->move(FCPATH . 'uploads/peneliti', $newName);
            $imagePath = 'uploads/peneliti/' . $newName;
        }

        $data = [
            'category'    => $this->request->getPost('category'),
            'name'        => trim($this->request->getPost('name')),
            'role'        => trim($this->request->getPost('role')),
            'role_en'     => trim($this->request->getPost('role_en') ?? ''),
            'faculty'     => trim($this->request->getPost('faculty') ?? ''),
            'faculty_en'  => trim($this->request->getPost('faculty_en') ?? ''),
            'focus'       => trim($this->request->getPost('focus') ?? ''),
            'focus_en'    => trim($this->request->getPost('focus_en') ?? ''),
            'cluster'     => trim($this->request->getPost('cluster') ?? ''),
            'nip'         => trim($this->request->getPost('nip') ?? ''),
            'scopus'      => trim($this->request->getPost('scopus') ?? ''),
            'email'       => trim($this->request->getPost('email')),
            'image'       => $imagePath,
            'order_num'   => (int) ($this->request->getPost('order_num') ?? 0),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $this->penelitiModel->update($id, $data);

        return redirect()->to(base_url('admin/peneliti'))->with('success', 'Data peneliti berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $peneliti = $this->penelitiModel->find($id);

        if (! $peneliti) {
            return redirect()->to(base_url('admin/peneliti'))->with('error', 'Peneliti tidak ditemukan.');
        }

        $this->penelitiModel->delete($id);

        return redirect()->to(base_url('admin/peneliti'))->with('success', 'Data peneliti berhasil dihapus.');
    }
}
