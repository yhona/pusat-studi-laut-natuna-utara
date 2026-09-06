<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Berita extends BaseController
{
    protected BeritaModel $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    /**
     * Display the list of news articles and announcements.
     */
    public function index(): string
    {
        $articles = $this->beritaModel->orderBy('published_at', 'DESC')->findAll();
        $categories = array_values(array_unique(array_filter(array_column($articles, 'category'))));

        $data = [
            'title'      => 'Berita & Agenda Kegiatan - Pusat Studi Laut Natuna Utara UMRAH',
            'articles'   => $articles,
            'categories' => $categories,
        ];

        return view('pages/berita', $data);
    }

    /**
     * Display a specific news article in full narrative detail.
     *
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function detail(string $slug): string
    {
        $article = $this->beritaModel->where('slug', $slug)->first();

        if (! $article) {
            throw PageNotFoundException::forPageNotFound('Artikel berita tidak ditemukan: ' . esc($slug));
        }

        $related = $this->getRelatedArticles($slug, 3);

        $data = [
            'title'   => $article['title'] . ' - North Natuna Sea Research Center UMRAH',
            'article' => $article,
            'related' => $related,
        ];

        return view('pages/berita_detail', $data);
    }

    /**
     * Get dynamically ranked related articles excluding current.
     */
    private function getRelatedArticles(string $currentSlug, int $limit = 3): array
    {
        $articles = $this->beritaModel->findAll();
        $current = null;

        foreach ($articles as $art) {
            if ($art['slug'] === $currentSlug) {
                $current = $art;
                break;
            }
        }

        $others = array_filter($articles, static fn($art) => $art['slug'] !== $currentSlug);

        if ($current) {
            usort($others, static function ($a, $b) use ($current) {
                $scoreA = ($a['category'] === $current['category'] ? 3 : 0)
                    + count(array_intersect($a['tags'] ?? [], $current['tags'] ?? []));
                $scoreB = ($b['category'] === $current['category'] ? 3 : 0)
                    + count(array_intersect($b['tags'] ?? [], $current['tags'] ?? []));
                return $scoreB <=> $scoreA;
            });
        }

        return array_slice(array_values($others), 0, $limit);
    }
}
