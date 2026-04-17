<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', '\Modules\Dashboard\Controllers\Dashboard::index');
$routes->get('/dashboard', '\Modules\Dashboard\Controllers\Dashboard::index');

// Auth
$routes->get('login', '\Modules\Auth\Controllers\Auth::index');
$routes->post('login/auth', '\Modules\Auth\Controllers\Auth::login');
$routes->get('logout', '\Modules\Auth\Controllers\Auth::logout');

// Resepsionis
$routes->group('resepsionis', function($routes) {
    $routes->get('pendaftaran', '\Modules\Resepsionis\Controllers\Resepsionis::pendaftaran');
    $routes->get('antrean', '\Modules\Resepsionis\Controllers\Resepsionis::antrean');
});

// Dokter
$routes->group('dokter', function($routes) {
    $routes->get('antrean', '\Modules\Dokter\Controllers\Dokter::antrean');
    $routes->get('soap', '\Modules\Dokter\Controllers\Dokter::soap');
});

// Apoteker
$routes->group('apoteker', function($routes) {
    $routes->get('resep', '\Modules\Apoteker\Controllers\Apoteker::resep');
    $routes->get('stok', '\Modules\Apoteker\Controllers\Apoteker::stok');
});

// Kasir
$routes->get('kasir/billing', '\Modules\Kasir\Controllers\Kasir::billing');

// Misc
$routes->get('laporan', '\Modules\Dashboard\Controllers\Dashboard::laporan');
$routes->get('profile', '\Modules\Dashboard\Controllers\Dashboard::profile');
$routes->get('pengaturan', '\Modules\Dashboard\Controllers\Dashboard::pengaturan');
