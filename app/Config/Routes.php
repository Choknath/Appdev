<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/market/getData', 'MarketController::getData');
$routes->get('/userprofile/(:any)','ProfileController::status/$1');
$routes->get('/Users', 'UserController::showuser');
$routes->post('/register', 'USerController::register');
$routes->post('/checkusername', 'USerController::checkUsernameAvailability');
$routes->post('/checkemail', 'USerController::checkEmailAvailability');
// $routes->post('/chekcFullname','UserController:: checkFullNameAvailability');
$routes->match(['post','get'],'/login', 'UserController::login');
$routes->get('/post/(:any)', 'PostController::getPost/$1');
$routes->get('/Event', 'EventController::getevent');
$routes->post('/addEvent', 'EventController::addEvent');
$routes->get('/content', 'PostController::ContentPost');
$routes ->get('/Logout','UserController::logout');
$routes->get('/displayevent/(:any)', 'EventController::postEvent/$1');




