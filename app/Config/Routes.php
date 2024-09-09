<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 
$routes->get('/', 'MenuController::index');
$routes->get('/projects', 'MenuController::projects');

$routes->get('/register', 'MenuController::register');

$routes->get('/homepage', 'MenuController::homepage');
$routes->get('/admin', 'MenuController::admin');
$routes->get('/register-menu/(:num)', 'MenuController::menuregister/$1', ['filter' => 'login']);
$routes->get('/tables/(:num)', 'MenuController::tables/$1', ['filter' => 'login']);
$routes->get('/menu/(:num)', 'MenuController::menus/$1', ['filter' => 'login']); 
$routes->get('/order/(:num)', 'MenuController::menus/$1');
$routes->get('/register-menu-name/(:num)', 'MenuController::register_menu/$1', ['filter' => 'login']);

$routes->get('/register-business/(:num)', 'MenuController::register_business/$1', ['filter' => 'login']);




$routes->get('/login', 'Auth::google_login');  // Route to initiate Google login
$routes->get('/login/callback', 'Auth::google_callback');  // Callback route after Google auth
$routes->get('/logout', 'Auth::logout');




$routes->get('/upload', 'FileUploadController::index');
$routes->post('/upload/(:num)', 'FileUploadController::upload/$1');

$routes->resource('business');
$routes->resource('category');
$routes->resource('items');
$routes->resource('menu');
$routes->resource('orderitem');
$routes->resource('order');
$routes->resource('tables');
$routes->resource('user');
$routes->get('/qrcode/(:num)', 'MenuController::generateQRCode/$1');
