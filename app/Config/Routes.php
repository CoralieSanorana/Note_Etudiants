<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/eleves', 'Eleve::index');
$routes->get('/eleves/(:num)/form', 'Eleve::edit/$1');
$routes->get('/eleves/(:num)/view', 'Eleve::view/$1');
$routes->get('/formulaire', 'Formulaire::index');

