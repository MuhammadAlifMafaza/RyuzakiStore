<?php

namespace Config;

$routes = Services::routes();

// Load the system's routing file first
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Default route untuk halaman utama
$routes->get('/', 'CustomerController::index'); // Halaman home untuk semua pengguna

// Halaman login dan logout (umum untuk semua)
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->get('/auth/logout', 'AuthController::logout');
$routes->get('/unauthorized', 'AuthController::unauthorized'); // Halaman jika akses tidak diizinkan

// Kelompokkan rute untuk admin dengan filter autentikasi
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'AdminController::index'); // Dashboard admin
    $routes->get('dashboard', 'AdminController::dashboard'); // Alias dashboard
    $routes->get('settings', 'AdminController::settings'); // Contoh halaman lain
    $routes->get('users', 'AdminController::users'); // Contoh manajemen pengguna
});

// Kelompokkan rute untuk owner dengan filter autentikasi
$routes->group('owner', ['filter' => 'auth:owner'], function ($routes) {
    $routes->get('/', 'OwnerController::index'); // Dashboard owner
    $routes->get('dashboard', 'OwnerController::dashboard'); // Alias dashboard
    $routes->get('reports', 'OwnerController::reports'); // Contoh halaman laporan
});

// Rute untuk customer tanpa autentikasi
$routes->group('customer', function ($routes) {
    $routes->get('/', 'CustomerController::index'); // Halaman utama untuk customer
    $routes->get('profile', 'CustomerController::profile'); // Profil customer
});

// Rute registrasi berdasarkan role
$routes->get('/register', 'AuthController::register'); // Halaman registrasi (umum)
$routes->post('/auth/registerProcess', 'AuthController::registerProcess'); // Proses registrasi
