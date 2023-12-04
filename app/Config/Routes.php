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
//chech kung may user na na nakapag register
$routes->post('/checkusername', 'USerController::checkUsernameAvailability');
//check kung nagamit na yung email 
$routes->post('/checkemail', 'USerController::checkEmailAvailability');
// $routes->post('/chekcFullname','UserController:: checkFullNameAvailability');
//para sa pag lologin 
$routes->match(['post','get'],'/login', 'UserController::login');
//Contetnt  na ikaw ang gumawa
$routes->get('/post/(:any)', 'PostController::getPost/$1');
//pag kuha lahat ng mga pinost ni user sa about sa event
$routes->get('/Event', 'EventController::getevent');
//pag dadagdag ng event 
$routes->post('/addEvent', 'EventController::addEvent');
// sa laaht ng nag post sa communityt 
$routes->get('/content', 'PostController::ContentPost');
//pag lolog out ni user 
$routes ->get('/Logout','UserController::logout');      
//event na iakw ang nag gawa 
$routes->get('/displayevent/(:any)', 'EventController::postEvent/$1');
//para makita yung mga user na message
$routes->get('/ Users','MessamgeController::Users');




