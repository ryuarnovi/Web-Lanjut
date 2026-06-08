<?php
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ============ PUBLIC (Landing) ============
$routes->group('', ['namespace' => 'App\Modules\general\Controllers'], function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('about', 'Home::about');
    $routes->get('service', 'Home::service');
    $routes->get('contact', 'Home::contact');
});

// ============ AUTH ============
$routes->group('', ['namespace' => 'App\Modules\Auth\Controllers'], function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::doLogin');
    $routes->get('logout', 'Auth::logout');
});

// ============ DASHBOARD (Admin) ============
$routes->group('dashboard', ['namespace' => 'App\Modules\Dashboard\Controllers', 'filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('users', 'Dashboard::users');
    $routes->get('settings', 'Dashboard::settings');
    $routes->get('reports', 'Dashboard::reports');
    $routes->get('logs', 'Dashboard::logs');
    $routes->get('profile', 'Dashboard::profile');
});

// ============ ROLE MODULES ============
$routes->group('resepsionis', ['namespace' => 'App\Modules\Resepsionis\Controllers', 'filter' => 'auth:admin,resepsionis'], function ($routes) {
    $routes->get('/', 'Resepsionis::index');
    $routes->get('pendaftaran', 'Resepsionis::pendaftaran');
    $routes->get('antrean', 'Resepsionis::antrean');
});

$routes->group('dokter', ['namespace' => 'App\Modules\Dokter\Controllers', 'filter' => 'auth:admin,dokter'], function ($routes) {
    $routes->get('/', 'Dokter::index');
    $routes->get('antrean', 'Dokter::antrean');
    $routes->get('soap/(:num)', 'Dokter::soap/$1');
});

$routes->group('perawat', ['namespace' => 'App\Modules\Perawat\Controllers', 'filter' => 'auth:admin,perawat'], function ($routes) {
    $routes->get('/', 'Perawat::index');
    $routes->get('antrean', 'Perawat::antrean');
    $routes->get('triase/(:num)', 'Perawat::triase/$1');
});

$routes->group('apoteker', ['namespace' => 'App\Modules\Apoteker\Controllers', 'filter' => 'auth:admin,apoteker'], function ($routes) {
    $routes->get('/', 'Apoteker::index');
    $routes->get('stok', 'Apoteker::stok');
    $routes->get('form', 'Apoteker::form');
    $routes->get('resep', 'Apoteker::resep');
    $routes->get('supplier', 'Apoteker::supplier');
});

$routes->group('kasir', ['namespace' => 'App\Modules\Kasir\Controllers', 'filter' => 'auth:admin,kasir'], function ($routes) {
    $routes->get('/', 'Kasir::index');
    $routes->get('billing', 'Kasir::billing');
    $routes->get('riwayat', 'Kasir::riwayat');
});

// ============ API (session auth) ============
$routes->group('api', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('dashboard/stats', '\App\Modules\Dashboard\Controllers\Dashboard::apiStats');
    $routes->get('activity-logs', '\App\Modules\Dashboard\Controllers\Dashboard::apiLogs');
    // Users
    $routes->get('users', '\App\Modules\Auth\Controllers\Auth::apiList');
    $routes->post('users', '\App\Modules\Auth\Controllers\Auth::apiCreate');
    $routes->put('users/(:num)', '\App\Modules\Auth\Controllers\Auth::apiUpdate/$1');
    $routes->delete('users/(:num)', '\App\Modules\Auth\Controllers\Auth::apiDelete/$1');
    $routes->get('users/me', '\App\Modules\Auth\Controllers\Auth::apiMe');
    // Settings
    $routes->get('settings', '\App\Modules\Dashboard\Controllers\Dashboard::apiSettings');
    $routes->put('settings', '\App\Modules\Dashboard\Controllers\Dashboard::apiSaveSettings');
});
