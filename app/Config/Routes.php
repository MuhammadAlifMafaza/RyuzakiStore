<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'CustomerController::index');


$routes->get('login', 'AuthController::login');
$routes->post('process-login', 'AuthController::processLogin'); // for POST login
$routes->get('logout', 'AuthController::logout');
$routes->get('register', 'AuthController::register');
$routes->post('process-register', 'AuthController::processRegister'); // for POST registration

// Route for Forgot Password Step 1
$routes->get('forgot-password', 'AuthController::forgotPasswordStep1');
$routes->post('verify-user', 'AuthController::verifyUser');  // For POST request

// Route for Reset Password page (with customer ID)
$routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->post('update-password', 'AuthController::updatePassword');  // For POST request

// Kelompokkan rute untuk customer
$routes->group('', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('/', 'CustomerController::index');
    $routes->get('/', 'CustomerController::index');
    $routes->get('checkout', 'CustomerController::checkout');
});

// rute untuk admin
$routes->group('admin', ['filter' => 'authfilter'], function ($routes) {
    // $routes->get('/', 'AuthController::login'); // Halaman login admin (dikecualikan dari filter)
    $routes->get('/', 'AdminController::dashboard');
    $routes->get('settings', 'AdminController::settings');
});

// rute untuk owner
$routes->group('owner', ['filter' => 'authfilter'], function ($routes) {
    // $routes->get('/', 'AuthController::login'); // Halaman login owner (dikecualikan dari filter)
    $routes->get('/', 'OwnerController::dashboard');
    $routes->get('reports', 'OwnerController::reports');
});
