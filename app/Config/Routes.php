<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Define your routes here
$routes->get('/', 'Login::login'); // Halaman login
$routes->get('/login', 'Login::login'); // Halaman login
$routes->post('/auth/loginProcess', 'Login::loginProcess'); // Proses login
$routes->get('/auth/logout', 'Login::logout'); // Proses logout

// Kelompokkan rute untuk admin
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'AdminController::index'); // Halaman dashboard admin
    // Tambahkan rute admin lainnya di sini
});

// Kelompokkan rute untuk customer
$routes->group('customer', function($routes) {
    $routes->get('home', 'CustomerController::index'); // Halaman dashboard customer
    // Tambahkan rute customer lainnya di sini
});

// Add more routes as needed