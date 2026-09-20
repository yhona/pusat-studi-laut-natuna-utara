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
}
