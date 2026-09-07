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
        $isEn = (service('request')->getLocale() === 'en');
        $articles = $this->beritaModel->orderBy('published_at', 'DESC')->findAll();

        if ($isEn) {
            foreach ($articles as &$art) {
                if ($art['category'] === 'Riset') {
                    $art['category'] = 'Research';
                } elseif ($art['category'] === 'Kerjasama') {
                    $art['category'] = 'Partnership';
                } elseif ($art['category'] === 'Pengabdian') {
                    $art['category'] = 'Community Service';
                } elseif ($art['category'] === 'Seminar') {
                    $art['category'] = 'Conference';
                }
            }
            unset($art);
        }

        $categories = array_values(array_unique(array_filter(array_column($articles, 'category'))));

        $data = [
            'title'      => $isEn ? 'News & Maritime Agenda - NNSRC UMRAH' : 'Berita & Agenda Kegiatan - Pusat Studi Laut Natuna Utara UMRAH',
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
        $isEn = (service('request')->getLocale() === 'en');

        $aliases = [
            'ekspedisi-maritim-natuna-utara-2026' => 'didukung-pendanaan-dari-pulitzer-center-umrah-dan-uns-kolaborasi-riset-internasional',
            'pulitzer-center-umrah'               => 'didukung-pendanaan-dari-pulitzer-center-umrah-dan-uns-kolaborasi-riset-internasional',
            'peluncuran-pusat-studi'              => 'umrah-luncurkan-pusat-studi-laut-natuna-utara-perkuat-kedaulatan-maritim-perbatasan',
            'mou-bskln-kemlu'                     => 'bskln-kemlu-dan-umrah-resmi-jalin-kerjasama-strategis-pendirian-pusat-studi-laut-natuna-utara',
        ];

        if (isset($aliases[$slug])) {
            $slug = $aliases[$slug];
        }

        $article = $this->beritaModel->where('slug', $slug)->first();

        if (! $article) {
            throw PageNotFoundException::forPageNotFound('Artikel berita tidak ditemukan: ' . esc($slug));
        }

        if ($isEn) {
            if ($article['category'] === 'Riset') {
                $article['category'] = 'Research';
            } elseif ($article['category'] === 'Kerjasama') {
                $article['category'] = 'Partnership';
            } elseif ($article['category'] === 'Pengabdian') {
                $article['category'] = 'Community Service';
            } elseif ($article['category'] === 'Seminar') {
                $article['category'] = 'Conference';
            }
        }

        $related = $this->getRelatedArticles($slug, 3);

        if ($isEn) {
            foreach ($related as &$rel) {
                if ($rel['category'] === 'Riset') {
                    $rel['category'] = 'Research';
                } elseif ($rel['category'] === 'Kerjasama') {
                    $rel['category'] = 'Partnership';
                } elseif ($rel['category'] === 'Pengabdian') {
                    $rel['category'] = 'Community Service';
                } elseif ($rel['category'] === 'Seminar') {
                    $rel['category'] = 'Conference';
                }
            }
            unset($rel);
        }

        $data = [
            'title'   => $article['title'],
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
