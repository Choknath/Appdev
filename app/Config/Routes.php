<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/market/getData', 'MarketController::getData');
//pag kuha lahat ng items
$routes->get('/Items', 'MarketController::getItmes');
//pag Pag lalagay ng product o kaya i tratrade
$routes->post('/insertProduct', 'MarketController::insertProduct');
//pag reregister ng shops 
$routes->post('/CreateStore', 'MarketController::CreateStore');
// duspaly sa profile at sa market
$routes->get('/ownitems/(:any)', 'MarketController::ownitems/$1');


$routes->get('/userprofile/(:any)','ProfileController::status/$1');
$routes->put('updateprofile/(:any)', 'ProfileController::updateProfile/$1');



$routes->get('/Users', 'UserController::showuser');
$routes->post('/register', 'USerController::register');
// Assuming you have a routes.php or similar file
$routes->post('/logout', 'UserController::logout');
// pag gawa ng superaccount na ma giging admin
$routes->post('/Superacc', 'UserController::Superacc');


//inserting of itmes
//chech kung may user na na nakapag register
$routes->post('/checkusername', 'USerController::checkUsernameAvailability');
//check kung nagamit na yung email 
$routes->post('/checkemail', 'USerController::checkEmailAvailability');
// $routes->post('/chekcFullname','UserController:: checkFullNameAvailability');



//para sa pag lologin 
$routes->match(['post','get'],'/login', 'UserController::login');
//pag lolog out ni user 
$routes ->get('/Logout','UserController::logout');  
//reset pass word
$routes->post('/forgotPassword', 'UserController::resetPassword');
//file upload and update profile
$routes->put('user/updateProfile/(:num)', 'UserController::updateProfile/$1');



//Contetnt  na ikaw ang gumawa
$routes->get('/post/(:any)', 'PostController::getPost/$1');
// sa laaht ng nag post sa communityt 
$routes->get('/content', 'PostController::ContentPost');
//pad uupload ng post mo
$routes->post('/Post', 'PostController::PostMedia');
//pag lilike ng post 
$routes->post('/likePost/(:num)/(:num)', 'PostController::likePost/$1/$2');
//pag cocoments sa post
$routes->post('/submitComment/(:num)/(:num)/(:any)', 'PostController::submitComment/$1/$2/$3');


//pag kuha lahat ng mga pinost ni user sa about sa event
$routes->get('/Event', 'EventController::getevent');
//pag dadagdag ng event 
$routes->post('/addEvent', 'EventController::addEvent');



//event na iakw ang nag gawa 
$routes->get('/displayevent/(:any)', 'EventController::postEvent/$1');


$routes->post('/sendMessage', 'MessageController::sendMessage');
$routes->get('/receivemessage/(:num)', 'MessageController::fetchMessages/$1');





