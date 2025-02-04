<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', to: 'CustomerController::index');
$routes->get('/products/', 'ProductController::detail');
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

// Rute untuk admin
$routes->group('admin', function ($routes) {
    $routes->get('/', 'AdminController::dashboard');

    $routes->get('product-list', 'ProductController::index');
    $routes->get('create-product', 'ProductController::create');
    $routes->post('store-product', 'ProductController::store');

    $routes->get('update-product/(:any)', 'ProductController::edit/$1');
    $routes->post('update-product/(:any)', 'ProductController::update/$1');

    $routes->get('detail-product/(:any)', 'ProductController::show/$1');

    $routes->post('admin/delete-product/(:num)', 'ProductController::delete/$1');
    // Settings
    $routes->get('settings', 'AdminController::settings');
});


$routes->group('owner', function ($routes) {
    $routes->get('/', 'OwnerController::dashboard');

    $routes->get('/product-list', 'ProductController::index');
    $routes->get('/create-product', 'ProductController::create');
    $routes->post('/store-product', 'ProductController::store');

    $routes->get('/update-product/(:any)', 'ProductController::edit/$1');
    $routes->post('/update-product/(:any)', 'ProductController::update/$1');

    $routes->get('/detail-product/(:any)', 'ProductController::show/$1');

    $routes->delete('/delete-product/(:any)', 'ProductController::delete/$1');

    // report
    $routes->get('reports', 'OwnerController::reports');
    // Settings
    $routes->get('settings', 'OwnerController::settings');
});
