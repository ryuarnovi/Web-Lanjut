<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- HALAMAN PUBLIK (TANPA AUTH) ---
$routes->get('login', '\Modules\Auth\Controllers\Auth::index');
$routes->post('login/auth', '\Modules\Auth\Controllers\Auth::login');
$routes->get('logout', '\Modules\Auth\Controllers\Auth::logout');


// --- HALAMAN TERPROTEKSI (PERLU LOGIN) ---
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Dashboard (Semua role yang login bisa akses)
    $routes->get('/', '\Modules\Dashboard\Controllers\Dashboard::index');
    $routes->get('dashboard', '\Modules\Dashboard\Controllers\Dashboard::index');
    
    // Fitur Umum (Profile, Pengaturan, Laporan)
    $routes->get('laporan', '\Modules\Dashboard\Controllers\Dashboard::laporan');
    $routes->get('profile', '\Modules\Dashboard\Controllers\Dashboard::profile');
    $routes->get('pengaturan', '\Modules\Dashboard\Controllers\Dashboard::pengaturan');


    // Resepsionis (Admin & Resepsionis saja)
    $routes->group('resepsionis', ['filter' => 'auth:admin,resepsionis'], function($routes) {
        $routes->get('pendaftaran', '\Modules\Resepsionis\Controllers\Resepsionis::pendaftaran');
        $routes->get('antrean', '\Modules\Resepsionis\Controllers\Resepsionis::antrean');
    });

    // Dokter (Admin & Dokter saja)
    $routes->group('dokter', ['filter' => 'auth:admin,dokter'], function($routes) {
        $routes->get('antrean', '\Modules\Dokter\Controllers\Dokter::antrean');
        $routes->get('soap', '\Modules\Dokter\Controllers\Dokter::soap');
    });

    // Apoteker (Admin & Apoteker saja)
    $routes->group('apoteker', ['filter' => 'auth:admin,apoteker'], function($routes) {
        $routes->get('resep', '\Modules\Apoteker\Controllers\Apoteker::resep');
        $routes->get('stok', '\Modules\Apoteker\Controllers\Apoteker::stok');
        $routes->get('form', '\Modules\Apoteker\Controllers\Apoteker::form');
    });

    // Kasir (Admin & Kasir saja)
    $routes->group('kasir', ['filter' => 'auth:admin,kasir'], function($routes) {
        $routes->get('data', '\Modules\Kasir\Controllers\Kasir::data');
        $routes->get('billing', '\Modules\Kasir\Controllers\Kasir::billing');
        $routes->get('form', '\Modules\Kasir\Controllers\Kasir::form');
    });
});

$routes->get('general', '\Modules\General\Controllers\General::General');
$routes->get('service', '\Modules\General\Controllers\General::Service');
$routes->get('about', '\Modules\General\Controllers\General::About');
$routes->get('contact', '\Modules\General\Controllers\General::Contact');