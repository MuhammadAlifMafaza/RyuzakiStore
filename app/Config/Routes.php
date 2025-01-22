<?php

namespace Config;

$routes = Services::routes();

// Load the system's routing file first
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Default route untuk halaman utama
$routes->get('/', 'CustomerController::index'); // Halaman home untuk semua pengguna

// Halaman login dan logout
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->get('/auth/logout', 'AuthController::logout');

// Kelompokkan rute untuk admin dengan filter autentikasi
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'AdminController::index'); // Dashboard admin (menggunakan index sebagai halaman dashboard)
    // Rute admin lainnya
});

// Kelompokkan rute untuk owner dengan filter autentikasi
$routes->group('owner', ['filter' => 'auth:owner'], function ($routes) {
    $routes->get('/', 'OwnerController::index'); // Dashboard owner (menggunakan index sebagai halaman dashboard)
    // Rute owner lainnya
});

// Rute untuk customer tanpa autentikasi
$routes->group('customer', function ($routes) {
    $routes->get('/', 'CustomerController::index'); // Halaman utama untuk customer
    $routes->get('login', 'AuthController::login'); // Halaman login untuk customer
    $routes->post('loginProcess', 'AuthController::loginProcess'); // Proses login untuk customer
    $routes->get('logout', 'AuthController::logout'); // Logout melalui AuthController
});
