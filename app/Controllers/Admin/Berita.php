<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    protected BeritaModel $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    public function index(): string
    {
        $articles = $this->beritaModel->orderBy('published_at', 'DESC')->findAll();

        $data = [
            'title'    => 'Kelola Berita & Agenda - Admin NNSRC',
            'articles' => $articles,
        ];

        return view('admin/berita/index', $data);
    }

    public function create(): string
    {
        $data = [
            'title' => 'Tambah Berita & Agenda Baru - Admin NNSRC',
        ];

        return view('admin/berita/create', $data);
    }

    public function store()
    {
        $title   = trim((string) $this->request->getPost('title'));
        $slug    = url_title(strtolower($title), '-', true);
        $excerpt = trim((string) $this->request->getPost('excerpt'));
        $content = trim((string) $this->request->getPost('content'));
        $category = trim((string) $this->request->getPost('category'));
        $author   = trim((string) $this->request->getPost('author'));
        $authorRole = trim((string) $this->request->getPost('author_role'));
        $tagsInput = trim((string) $this->request->getPost('tags'));

        // Handle tags array
        $tagsArray = array_values(array_filter(array_map('trim', explode(',', $tagsInput))));

        // Handle paragraphs for content json
        $paragraphs = array_values(array_filter(array_map('trim', explode("\n", $content))));

        // Handle image upload
        $imagePath = 'images/berita/pulitzer_center_umrah_uns.jpg'; // default fallback
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/berita', $newName);
            $imagePath = 'images/berita/' . $newName;
        }

        $saveData = [
            'title'          => $title,
            'slug'           => $slug,
            'category'       => $category,
            'excerpt'        => $excerpt,
            'content'        => json_encode($paragraphs, JSON_UNESCAPED_UNICODE),
            'author'         => $author,
            'author_role'    => $authorRole,
            'read_time'      => '3 menit baca',
            'image'          => $imagePath,
            'image_caption'  => trim((string) $this->request->getPost('image_caption')),
            'date_formatted' => date('d F Y'),
            'tags'           => json_encode($tagsArray, JSON_UNESCAPED_UNICODE),
            'tag'            => $tagsArray[0] ?? $category,
            'is_featured'    => $this->request->getPost('is_featured') ? 1 : 0,
            'published_at'   => date('Y-m-d H:i:s'),
        ];

        if (! $this->beritaModel->save($saveData)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan berita. Mohon periksa kembali isian formulir.');
        }

        return redirect()->to(base_url('admin/berita'))
            ->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function edit(int $id): string
    {
        $article = $this->beritaModel->find($id);
        if (! $article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan.');
        }

        $data = [
            'title'   => 'Sunting Berita: ' . $article['title'],
            'article' => $article,
        ];

        return view('admin/berita/edit', $data);
    }

    public function update(int $id)
    {
        $article = $this->beritaModel->find($id);
        if (! $article) {
            return redirect()->to(base_url('admin/berita'))->with('error', 'Berita tidak ditemukan.');
        }

        $title   = trim((string) $this->request->getPost('title'));
        $content = trim((string) $this->request->getPost('content'));
        $tagsInput = trim((string) $this->request->getPost('tags'));

        $tagsArray = array_values(array_filter(array_map('trim', explode(',', $tagsInput))));
        $paragraphs = array_values(array_filter(array_map('trim', explode("\n", $content))));

        $updateData = [
            'id'             => $id,
            'title'          => $title,
            'category'       => trim((string) $this->request->getPost('category')),
            'excerpt'        => trim((string) $this->request->getPost('excerpt')),
            'content'        => json_encode($paragraphs, JSON_UNESCAPED_UNICODE),
            'author'         => trim((string) $this->request->getPost('author')),
            'author_role'    => trim((string) $this->request->getPost('author_role')),
            'image_caption'  => trim((string) $this->request->getPost('image_caption')),
            'tags'           => json_encode($tagsArray, JSON_UNESCAPED_UNICODE),
            'tag'            => $tagsArray[0] ?? $this->request->getPost('category'),
            'is_featured'    => $this->request->getPost('is_featured') ? 1 : 0,
        ];

        // Image check
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'images/berita', $newName);
            $updateData['image'] = 'images/berita/' . $newName;
        }

        if (! $this->beritaModel->save($updateData)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui berita.');
        }

        return redirect()->to(base_url('admin/berita'))
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function delete(int $id)
    {
        $this->beritaModel->delete($id);
        return redirect()->to(base_url('admin/berita'))
            ->with('success', 'Berita berhasil dihapus.');
    }
}
