<?php

namespace Config;

use Config\Services;

$routes = Services::routes();

// Load the system's routing file first
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Default route untuk halaman utama (home) tanpa login untuk customer
$routes->get('/', 'CustomerController::index'); // Halaman home untuk semua pengguna

// Halaman login dan logout (umum untuk semua)
$routes->get('/login', 'AuthController::login'); // Halaman login
$routes->post('/auth/loginProcess', 'AuthController::loginProcess'); // Proses login
$routes->get('/auth/logout', 'AuthController::logout'); // Proses logout

// Kelompokkan rute untuk admin dengan filter autentikasi
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'AdminController::index'); // Halaman utama untuk admin
    $routes->get('dashboard', 'AdminController::dashboard'); // Dashboard admin
    $routes->get('settings', 'AdminController::settings'); // Halaman pengaturan
    $routes->get('users', 'AdminController::users'); // Manajemen pengguna
});

// Kelompokkan rute untuk owner dengan filter autentikasi
$routes->group('owner', ['filter' => 'auth:owner'], function ($routes) {
    $routes->get('/', 'OwnerController::index'); // Halaman utama untuk owner
    $routes->get('dashboard', 'OwnerController::dashboard'); // Dashboard owner
    $routes->get('reports', 'OwnerController::reports'); // Laporan owner
});

// Rute untuk customer tanpa autentikasi tetapi tetap bisa login dan logout
// Customer tetap bisa akses halaman home tanpa login, dan login/logout akan tetap berfungsi
$routes->group('', ['filter' => 'auth:customer'], function ($routes) {
    $routes->get('customer', 'CustomerController::index'); // Halaman utama untuk customer
    $routes->get('customer/profile', 'CustomerController::profile'); // Profil customer
});

// Rute registrasi (umum)
$routes->get('/register', 'AuthController::register'); // Halaman registrasi
$routes->post('/auth/registerProcess', 'AuthController::registerProcess'); // Proses registrasi
