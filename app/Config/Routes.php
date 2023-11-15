<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['post','get']'/login', 'UserController::login');
$routes->get('/getData', 'AuthController::getData');
