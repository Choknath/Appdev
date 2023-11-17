<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/market/getData', 'MarketController::getData');
$routes->get('/Profile', 'ProfileController::status');
$routes->get('/Users', 'UserController::showuser');
$routes-.get('/registe', 'USerController::register')
