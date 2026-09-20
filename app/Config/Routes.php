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
    $routes->post('publikasi/update-brief', 'Admin\Publikasi::updateBrief');

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

    // Profil & Visi Misi
    $routes->get('profil', 'Admin\Profil::index');
    $routes->post('profil/update', 'Admin\Profil::update');

    // Klaster Riset
    $routes->get('klaster', 'Admin\Klaster::index');
    $routes->get('klaster/edit/(:num)', 'Admin\Klaster::edit/$1');
    $routes->post('klaster/update/(:num)', 'Admin\Klaster::update/$1');

    // Pengaturan Akun & Keamanan
    $routes->get('pengaturan', 'Admin\Pengaturan::index');
    $routes->post('pengaturan/update', 'Admin\Pengaturan::updateProfile');

    // Status Sistem & Cache
    $routes->get('sistem', 'Admin\Sistem::index');
    $routes->post('sistem/clear-cache', 'Admin\Sistem::clearCache');
});

