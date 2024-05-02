<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->post('user/login', 'User::login');
$routes->get('user/logout', 'User::logout');
$routes->get('publication', 'Publication::index'); // Cambiado de 'post' a 'publication'
$routes->add('post', 'Home::index');
$routes->add('publication/add', 'Publication::add');
$routes->add('publication/edit/(:num)', 'Publication::edit/$1');
$routes->add('publication/delete/(:num)', 'Publication::delete/$1');
$routes->post('publication/uploadImage', 'Publication::uploadImage');
$routes->post('user/login', 'User::login');
