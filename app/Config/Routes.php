<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/market/getData', 'MarketController::getData');
$routes->get('/userprofile','ProfileController::status');
$routes->get('/Users', 'UserController::showuser');
$routes->post('/register', 'USerController::register');
$routes->match(['post','get'],'/login', 'UserController::login');

