<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', to: 'CustomerController::index');
$routes->get('/products/', 'CustomerController::products');
$routes->get('/profile/', 'CustomerController::profile');

// Rute untuk AuthAdminController
$routes->get('adminAuth/login', 'Admin\AuthAdminController::login'); // Halaman login
$routes->post('adminAuth/processLogin', 'Admin\AuthAdminController::processLogin'); // Proses login
$routes->get('adminAuth/register', 'Admin\AuthAdminController::register'); // Halaman registrasi
$routes->post('adminAuth/processRegister', 'Admin\AuthAdminController::processRegister'); // Proses registrasi
$routes->get('adminAuth/logout', 'Admin\AuthAdminController::logout'); // Logout


// Kelompokkan rute untuk customer
$routes->group('', function ($routes) {
    $routes->get('/', 'CustomerController::index');
    $routes->get('checkout', 'CustomerController::checkout');
});

// rute untuk admin
$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');

    // Settings
    $routes->get('settings', 'AdminController::settings');
});


// rute untuk owner
// $routes->get('/', 'AuthController::login'); // Halaman login owner (dikecualikan dari filter)
$routes->get('owner/dashboard', 'OwnerController::dashboard');

$routes->get('reports', 'OwnerController::reports');


// Produk admin dan owner
$routes->get('/product-list', 'ProductController::index');
$routes->get('/create-product', 'ProductController::create');
$routes->post('/store-product', 'ProductController::store');

$routes->get('/update-product/(:any)', 'ProductController::edit/$1');
$routes->post('/update-product/(:any)', 'ProductController::update/$1');

$routes->get('/detail-product/(:any)', 'ProductController::show/$1');

$routes->delete('/delete-product/(:any)', 'ProductController::delete/$1');
