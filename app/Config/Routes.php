<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->setAutoRoute(true);

$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
