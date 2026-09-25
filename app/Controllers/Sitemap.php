<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KlasterRisetModel;
use CodeIgniter\HTTP\ResponseInterface;

class Sitemap extends BaseController
{
    /**
     * Generate dynamic XML sitemap conforming to sitemaps.org protocol.
     * Indexes all public portal routes, active research clusters, and published articles.
     */
    public function index(): ResponseInterface
    {
        $urls = [];
        $now = date('c');

        // 1. Core Public Static Pages
        $staticPages = [
            ['uri' => '',          'freq' => 'daily',   'priority' => '1.0'],
            ['uri' => 'profil',    'freq' => 'weekly',  'priority' => '0.8'],
            ['uri' => 'riset',     'freq' => 'weekly',  'priority' => '0.9'],
            ['uri' => 'layanan',   'freq' => 'weekly',  'priority' => '0.8'],
            ['uri' => 'publikasi', 'freq' => 'weekly',  'priority' => '0.9'],
            ['uri' => 'unduhan',   'freq' => 'weekly',  'priority' => '0.8'],
            ['uri' => 'berita',    'freq' => 'daily',   'priority' => '0.9'],
            ['uri' => 'kontak',    'freq' => 'monthly', 'priority' => '0.7'],
        ];

        foreach ($staticPages as $sp) {
            $urls[] = [
                'loc'        => base_url($sp['uri']),
                'lastmod'    => $now,
                'changefreq' => $sp['freq'],
                'priority'   => $sp['priority'],
            ];
        }

        // 2. Dynamic Research Clusters
        try {
            $klasterModel = new KlasterRisetModel();
            $clusters = $klasterModel->findAll();
            foreach ($clusters as $c) {
                if (!empty($c['slug'])) {
                    $urls[] = [
                        'loc'        => base_url('riset/' . $c['slug']),
                        'lastmod'    => !empty($c['updated_at']) ? date('c', strtotime($c['updated_at'])) : $now,
                        'changefreq' => 'weekly',
                        'priority'   => '0.85',
                    ];
                }
            }
        } catch (\Throwable $e) {
            // graceful fallback if table not ready
        }

        // 3. Dynamic News Articles
        try {
            $beritaModel = new BeritaModel();
            $articles = $beritaModel->findAll();
            foreach ($articles as $art) {
                if (!empty($art['slug'])) {
                    $modTime = !empty($art['updated_at']) ? $art['updated_at'] : (!empty($art['published_at']) ? $art['published_at'] : null);
                    $urls[] = [
                        'loc'        => base_url('berita/' . $art['slug']),
                        'lastmod'    => $modTime ? date('c', strtotime($modTime)) : $now,
                        'changefreq' => 'monthly',
                        'priority'   => '0.85',
                    ];
                }
            }
        } catch (\Throwable $e) {
            // graceful fallback if table not ready
        }

        // Generate XML Content
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $u) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>" . htmlspecialchars($u['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <lastmod>" . $u['lastmod'] . "</lastmod>\n";
            $xml .= "        <changefreq>" . $u['changefreq'] . "</changefreq>\n";
            $xml .= "        <priority>" . $u['priority'] . "</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return $this->response
            ->setContentType('text/xml; charset=UTF-8')
            ->setBody($xml);
    }
}
