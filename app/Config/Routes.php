<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Profil & Personalia
$routes->get('/profil', 'Profil::index');

// Riset & Roadmap
$routes->get('/riset', 'Riset::index');
$routes->get('/riset/(:segment)', 'Riset::detail/$1');

// Layanan & Jasa Konsultasi (PSE UGM style)
$routes->get('/layanan', 'Layanan::index');

// Publikasi & Jurnal
$routes->get('/publikasi', 'Publikasi::index');

// Berita & Agenda
$routes->get('/berita', 'Berita::index');
$routes->get('/berita/(:segment)', 'Berita::detail/$1');

// Repositori Dokumen & Pusat Unduhan
$routes->get('/unduhan', 'Unduhan::index');
$routes->get('/unduhan/unduh/(:segment)', 'Unduhan::unduh/$1');
$routes->post('/unduhan/mohon-unduh', 'Unduhan::mohonUnduh');

// Multi-language switcher
$routes->get('lang/(:segment)', 'Language::switch/$1');

// Kontak & Formulir Kerjasama
$routes->get('/kontak', 'Kontak::index');
$routes->post('/kontak/kirim', 'Kontak::kirim');

// =============================================================================
// ADMIN DASHBOARD & CMS ROUTES
// =============================================================================
$routes->get('/admin/login', 'Admin\Auth::login');
$routes->post('/admin/login-action', 'Admin\Auth::loginAction');
$routes->get('/admin/logout', 'Admin\Auth::logout');

$routes->group('admin', ['filter' => 'adminAuth'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->post('cron/run', 'Admin\Dashboard::runCron');

    // Berita Management
    $routes->get('berita', 'Admin\Berita::index');
    $routes->get('berita/create', 'Admin\Berita::create');
    $routes->post('berita/store', 'Admin\Berita::store');
    $routes->get('berita/edit/(:num)', 'Admin\Berita::edit/$1');
    $routes->post('berita/update/(:num)', 'Admin\Berita::update/$1');
    $routes->post('berita/delete/(:num)', 'Admin\Berita::delete/$1');

    // Policy Brief & Publikasi
    $routes->get('publikasi', 'Admin\Publikasi::index');
    $routes->get('publikasi/create', 'Admin\Publikasi::create');
    $routes->post('publikasi/store', 'Admin\Publikasi::store');
    $routes->get('publikasi/edit/(:num)', 'Admin\Publikasi::edit/$1');
    $routes->post('publikasi/update/(:num)', 'Admin\Publikasi::update/$1');
    $routes->post('publikasi/delete/(:num)', 'Admin\Publikasi::delete/$1');

    // Jurnal Ilmiah Kemaritiman
    $routes->get('jurnal', 'Admin\Jurnal::index');
    $routes->get('jurnal/create', 'Admin\Jurnal::create');
    $routes->post('jurnal/store', 'Admin\Jurnal::store');
    $routes->get('jurnal/edit/(:num)', 'Admin\Jurnal::edit/$1');
    $routes->post('jurnal/update/(:num)', 'Admin\Jurnal::update/$1');
    $routes->post('jurnal/delete/(:num)', 'Admin\Jurnal::delete/$1');

    // Personalia & Dewan Peneliti
    $routes->get('peneliti', 'Admin\Peneliti::index');
    $routes->get('peneliti/create', 'Admin\Peneliti::create');
    $routes->post('peneliti/store', 'Admin\Peneliti::store');
    $routes->get('peneliti/edit/(:num)', 'Admin\Peneliti::edit/$1');
    $routes->post('peneliti/update/(:num)', 'Admin\Peneliti::update/$1');
    $routes->post('peneliti/delete/(:num)', 'Admin\Peneliti::delete/$1');

    // Layanan & Jasa Konsultasi
    $routes->get('layanan', 'Admin\Layanan::index');
    $routes->get('layanan/create', 'Admin\Layanan::create');
    $routes->post('layanan/store', 'Admin\Layanan::store');
    $routes->get('layanan/edit/(:num)', 'Admin\Layanan::edit/$1');
    $routes->post('layanan/update/(:num)', 'Admin\Layanan::update/$1');
    $routes->post('layanan/delete/(:num)', 'Admin\Layanan::delete/$1');

    // Unduhan & SOP Management
    $routes->get('unduhan', 'Admin\Unduhan::index');
    $routes->get('unduhan/create', 'Admin\Unduhan::create');
    $routes->post('unduhan/store', 'Admin\Unduhan::store');
    $routes->get('unduhan/edit/(:num)', 'Admin\Unduhan::edit/$1');
    $routes->post('unduhan/update/(:num)', 'Admin\Unduhan::update/$1');
    $routes->post('unduhan/delete/(:num)', 'Admin\Unduhan::delete/$1');

    // Permohonan Unduh & Kontak
    $routes->get('permohonan', 'Admin\Permohonan::index');
    $routes->post('permohonan/resend/(:num)', 'Admin\Permohonan::resendEmail/$1');
    $routes->post('permohonan/delete/(:num)', 'Admin\Permohonan::delete/$1');
    $routes->get('kontak', 'Admin\Kontak::index');
    $routes->post('kontak/update-status/(:num)', 'Admin\Kontak::updateStatus/$1');

    // Sambutan Pimpinan / Koordinator
    $routes->get('sambutan', 'Admin\Sambutan::index');
    $routes->post('sambutan/update', 'Admin\Sambutan::update');

    // Profil & Visi Misi
    $routes->get('profil', 'Admin\Profil::index');
    $routes->post('profil/update', 'Admin\Profil::update');

    // Klaster Riset
    $routes->get('klaster', 'Admin\Klaster::index');
    $routes->get('klaster/create', 'Admin\Klaster::create');
    $routes->post('klaster/store', 'Admin\Klaster::store');
    $routes->get('klaster/edit/(:num)', 'Admin\Klaster::edit/$1');
    $routes->post('klaster/update/(:num)', 'Admin\Klaster::update/$1');
    $routes->post('klaster/delete/(:num)', 'Admin\Klaster::delete/$1');

    // Roadmap Riset Kemaritiman
    $routes->get('roadmap', 'Admin\Roadmap::index');
    $routes->get('roadmap/create', 'Admin\Roadmap::create');
    $routes->post('roadmap/store', 'Admin\Roadmap::store');
    $routes->get('roadmap/edit/(:num)', 'Admin\Roadmap::edit/$1');
    $routes->post('roadmap/update/(:num)', 'Admin\Roadmap::update/$1');
    $routes->post('roadmap/delete/(:num)', 'Admin\Roadmap::delete/$1');

    // Counter Capaian Statistik & KPI
    $routes->get('statistik', 'Admin\Statistik::index');
    $routes->get('statistik/create', 'Admin\Statistik::create');
    $routes->post('statistik/store', 'Admin\Statistik::store');
    $routes->get('statistik/edit/(:num)', 'Admin\Statistik::edit/$1');
    $routes->post('statistik/update/(:num)', 'Admin\Statistik::update/$1');
    $routes->post('statistik/delete/(:num)', 'Admin\Statistik::delete/$1');

    // Banner & Slider Beranda
    $routes->get('banners', 'Admin\Banner::index');
    $routes->get('banners/create', 'Admin\Banner::create');
    $routes->post('banners/store', 'Admin\Banner::store');
    $routes->get('banners/edit/(:num)', 'Admin\Banner::edit/$1');
    $routes->post('banners/update/(:num)', 'Admin\Banner::update/$1');
    $routes->post('banners/delete/(:num)', 'Admin\Banner::delete/$1');

    // Mitra Kerjasama Strategis
    $routes->get('mitra', 'Admin\Mitra::index');
    $routes->get('mitra/create', 'Admin\Mitra::create');
    $routes->post('mitra/store', 'Admin\Mitra::store');
    $routes->get('mitra/edit/(:num)', 'Admin\Mitra::edit/$1');
    $routes->post('mitra/update/(:num)', 'Admin\Mitra::update/$1');
    $routes->post('mitra/delete/(:num)', 'Admin\Mitra::delete/$1');

    // Galeri Riset & Ekspedisi
    $routes->get('galeri', 'Admin\Galeri::index');
    $routes->get('galeri/create', 'Admin\Galeri::create');
    $routes->post('galeri/store', 'Admin\Galeri::store');
    $routes->get('galeri/edit/(:num)', 'Admin\Galeri::edit/$1');
    $routes->post('galeri/update/(:num)', 'Admin\Galeri::update/$1');
    $routes->post('galeri/delete/(:num)', 'Admin\Galeri::delete/$1');

    // Pengaturan Akun & Keamanan
    $routes->get('pengaturan', 'Admin\Pengaturan::index');
    $routes->post('pengaturan/update', 'Admin\Pengaturan::updateProfile');

    // Manajemen Pengguna Admin
    $routes->get('users', 'Admin\Users::index');
    $routes->get('users/create', 'Admin\Users::create');
    $routes->post('users/store', 'Admin\Users::store');
    $routes->get('users/edit/(:num)', 'Admin\Users::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\Users::update/$1');
    $routes->post('users/delete/(:num)', 'Admin\Users::delete/$1');

    // Pengaturan Identitas Situs, Kontak Institusi & Media Sosial
    $routes->get('identitas', 'Admin\Identitas::index');
    $routes->post('identitas/update', 'Admin\Identitas::update');

    // Audit Trail & Log Aktivitas Admin
    $routes->get('logs', 'Admin\Logs::index');
    $routes->post('logs/clear', 'Admin\Logs::clearOlder');

    // Status Sistem & Cache
    $routes->get('sistem', 'Admin\Sistem::index');
    $routes->post('sistem/clear-cache', 'Admin\Sistem::clearCache');
});

