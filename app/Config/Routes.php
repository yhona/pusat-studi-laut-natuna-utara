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

// Multi-language switcher
$routes->get('lang/(:segment)', 'Language::switch/$1');

// Kontak & Formulir Kerjasama
$routes->get('/kontak', 'Kontak::index');
$routes->post('/kontak/kirim', 'Kontak::kirim');
