<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/signup','Home::Signup');

$routes->post('/signup','Home::Signup');
$routes->get('/login','Home::Login');
$routes->post('/login','Home::Login');
$routes->get('/dashboard','Home::Dashboard');
$routes->get('/logout', 'Home::logout');
$routes->get('/delete/(:num)/(:any)', 'Home::deleteUser/$1/$2');
$routes->delete('/delete/(:num)/(:any)', 'Home::deleteUser/$1/$2');

$routes->post('/update', 'Home::update');

