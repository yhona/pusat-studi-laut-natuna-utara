<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KlasterRisetModel;

class Klaster extends BaseController
{
    protected KlasterRisetModel $klasterModel;

    public function __construct()
    {
        $this->klasterModel = new KlasterRisetModel();
    }

    public function index(): string
    {
        $klasters = $this->klasterModel->findAll();

        $data = [
            'title'   => 'Kelola Klaster Riset - Admin NNSRC',
            'klasters'=> $klasters,
        ];

        return view('admin/klaster/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Klaster Riset Baru - Admin NNSRC',
        ];

        return view('admin/klaster/create', $data);
    }

    public function store()
    {
        $shortTitle = trim((string) $this->request->getPost('short_title'));
        $title      = trim((string) $this->request->getPost('title'));
        $slugInput  = trim((string) $this->request->getPost('slug'));

        if ($shortTitle === '' || $title === '') {
            return redirect()->back()->withInput()->with('error', 'Judul klaster wajib diisi.');
        }

        // Generate slug
        $slug = !empty($slugInput) ? url_title($slugInput, '-', true) : url_title($shortTitle, '-', true);

        // Ensure unique slug
        $existing = $this->klasterModel->where('slug', $slug)->first();
        if ($existing) {
            $slug .= '-' . time();
        }

        // Coordinator data structure
        $coordinator = [
            'name'   => trim((string) $this->request->getPost('coordinator_name')),
            'role'   => trim((string) $this->request->getPost('coordinator_role')),
            'nip'    => trim((string) $this->request->getPost('coordinator_nip')),
            'scopus' => trim((string) $this->request->getPost('coordinator_scopus')),
            'email'  => trim((string) $this->request->getPost('coordinator_email')),
        ];

        // Focus areas list
        $rawFocus = (string) $this->request->getPost('focus_areas');
        $focusAreas = array_filter(array_map('trim', explode("\n", $rawFocus)));

        // Flagship projects list
        $rawProjects = (string) $this->request->getPost('flagship_projects');
        $flagshipProjects = array_filter(array_map('trim', explode("\n", $rawProjects)));

        $insertData = [
            'slug'              => $slug,
            'short_title'       => $shortTitle,
            'title'             => $title,
            'title_en'          => trim((string) $this->request->getPost('title_en')) ?: $title,
            'mandate'           => trim((string) $this->request->getPost('mandate')),
            'icon'              => trim((string) $this->request->getPost('icon')) ?: 'fa-solid fa-anchor',
            'badge'             => trim((string) $this->request->getPost('badge')) ?: 'Klaster Baru',
            'coordinator'       => json_encode($coordinator, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'focus_areas'       => json_encode(array_values($focusAreas), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'flagship_projects' => json_encode(array_values($flagshipProjects), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'facilities'        => json_encode(['Laboratorium Riset Kemaritiman UMRAH'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'publications'      => json_encode([], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];

        $this->klasterModel->insert($insertData);

        return redirect()->to(base_url('admin/klaster'))
            ->with('success', 'Klaster riset baru "' . esc($shortTitle) . '" berhasil ditambahkan ke portal!');
    }

    public function edit(int $id): string
    {
        $klaster = $this->klasterModel->find($id);
        if (! $klaster) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Klaster tidak ditemukan');
        }

        $data = [
            'title'   => 'Edit Klaster: ' . ($klaster['short_title'] ?? $klaster['title']),
            'klaster' => $klaster,
        ];

        return view('admin/klaster/edit', $data);
    }

    public function update(int $id)
    {
        $klaster = $this->klasterModel->find($id);
        if (! $klaster) {
            return redirect()->to(base_url('admin/klaster'))->with('error', 'Klaster tidak ditemukan.');
        }

        // Coordinator data structure
        $coordinator = [
            'name'   => trim($this->request->getPost('coordinator_name') ?? ''),
            'role'   => trim($this->request->getPost('coordinator_role') ?? ''),
            'nip'    => trim($this->request->getPost('coordinator_nip') ?? ''),
            'scopus' => trim($this->request->getPost('coordinator_scopus') ?? ''),
            'email'  => trim($this->request->getPost('coordinator_email') ?? ''),
        ];

        // Focus areas list
        $rawFocus = $this->request->getPost('focus_areas');
        $focusAreas = array_filter(array_map('trim', explode("\n", (string) $rawFocus)));

        // Flagship projects list
        $rawProjects = $this->request->getPost('flagship_projects');
        $flagshipProjects = array_filter(array_map('trim', explode("\n", (string) $rawProjects)));

        $updateData = [
            'short_title'       => trim($this->request->getPost('short_title') ?? $klaster['short_title']),
            'title'             => trim($this->request->getPost('title') ?? $klaster['title']),
            'title_en'          => trim($this->request->getPost('title_en') ?? ($klaster['title_en'] ?? $klaster['title'])),
            'mandate'           => trim($this->request->getPost('mandate') ?? $klaster['mandate']),
            'icon'              => trim($this->request->getPost('icon') ?? $klaster['icon']),
            'badge'             => trim($this->request->getPost('badge') ?? $klaster['badge']),
            'coordinator'       => json_encode($coordinator, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'focus_areas'       => json_encode(array_values($focusAreas), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'flagship_projects' => json_encode(array_values($flagshipProjects), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
        ];

        $this->klasterModel->update($id, $updateData);

        return redirect()->to(base_url('admin/klaster'))
            ->with('success', 'Data klaster riset "' . esc($updateData['short_title']) . '" berhasil diperbarui!');
    }

    public function delete(int $id)
    {
        $klaster = $this->klasterModel->find($id);
        if (! $klaster) {
            return redirect()->to(base_url('admin/klaster'))->with('error', 'Klaster tidak ditemukan.');
        }

        $title = $klaster['short_title'] ?? $klaster['title'];
        $this->klasterModel->delete($id);

        return redirect()->to(base_url('admin/klaster'))
            ->with('success', 'Klaster riset "' . esc($title) . '" berhasil dihapus.');
    }
}
