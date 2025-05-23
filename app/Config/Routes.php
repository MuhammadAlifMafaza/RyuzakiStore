<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthCustomerController::login'); // Redirect ke login utama

$routes->group('customerAuth', function ($routes) {
    $routes->get('login', 'AuthCustomerController::login');
    $routes->post('processLogin', 'AuthCustomerController::processLogin');
    $routes->get('logout', 'AuthCustomerController::logout');
    $routes->get('register', 'AuthCustomerController::register');
    $routes->post('processRegister', 'AuthCustomerController::processRegister');
});

$routes->group('', function ($routes) {
    // Semua route di dalam grup ini hanya dapat diakses jika pengguna sudah login
    $routes->get('home', 'CustomerController::index');
    $routes->get('products/(:segment)', 'ProductController::tampilDetail/$1');
    $routes->get('profile', 'CustomerController::profile');
    // Route keranjang
    $routes->get('cart', 'CartController::viewCart');
    $routes->post('cart/addToCart/(:any)', 'CartController::addToCart/$1');
    $routes->post('cart/update/(:any)', 'CartController::updateCart/$1');
    $routes->post('cart/update_quantity', 'CartController::update_quantity');
    $routes->get('cart/remove/(:any)', 'CartController::removeFromCart/$1');
    $routes->get('cart/clear', 'CartController::clearCart');
    // Route checkout
    $routes->get('checkout', 'CheckoutController::index');
    $routes->post('checkout/process', 'CheckoutController::processCheckout');
    $routes->get('order/detail/(:any)', 'OrderController::detail/$1');
});


// Rute untuk AuthAdminController
$routes->get('adminAuth/login', 'Admin\AuthAdminController::login'); // Halaman login
$routes->post('adminAuth/processLogin', 'Admin\AuthAdminController::processLogin'); // Proses login
$routes->get('adminAuth/register', 'Admin\AuthAdminController::register'); // Halaman registrasi
$routes->post('adminAuth/processRegister', 'Admin\AuthAdminController::processRegister'); // Proses registrasi
$routes->get('adminAuth/logout', 'Admin\AuthAdminController::logout'); // Logout


// Rute untuk admin
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'AdminController::dashboard');

    $routes->get('product-list', 'ProductController::indexByAdmin');
    $routes->get('create-product', 'ProductController::createByAdmin');
    $routes->post('store-product', 'ProductController::storeByAdmin');

    $routes->get('update-product/(:any)', 'ProductController::editByAdmin/$1');
    $routes->post('update-product/(:any)', 'ProductController::updateByAdmin/$1');

    $routes->get('detail-product/(:any)', 'ProductController::showByAdmin/$1');

    $routes->post('delete-product/(:num)', 'ProductController::deleteByAdmin/$1');

    // kelola data user

    // Settings
    $routes->get('settings', 'AdminController::settings');
});

// Rute untuk owner
$routes->group('owner', ['filter' => 'owner'], function ($routes) {
    // Dashboard Owner
    $routes->get('/', 'OwnerController::dashboard');

    // Rute untuk mengelola data produk
    $routes->get('/product-list', 'ProductController::indexByOwner');
    $routes->get('/create-product', 'ProductController::createByOwner');
    $routes->post('/store-product', 'ProductController::storeByOwner');

    $routes->get('/update-product/(:any)', 'ProductController::editByOwner/$1');
    $routes->post('/update-product/(:any)', 'ProductController::updateByOwner/$1');

    $routes->get('/detail-product/(:any)', 'ProductController::showByOwner/$1');

    $routes->delete('/delete-product/(:any)', 'ProductController::deleteByOwner/$1');

    // kelola data user

    // Rute untuk laporan
    // $routes->get('reports', 'OwnerController::reports');

    // Rute untuk pengaturan
    // $routes->get('settings', 'OwnerController::settings');
});
