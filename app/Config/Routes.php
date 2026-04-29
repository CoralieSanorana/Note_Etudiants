<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/eleves', 'Eleve::index');
$routes->get('/form', 'Eleve::edit');
$routes->post('/form', 'Eleve::storeNote');
$routes->get('/eleves/(:num)/view', 'Eleve::view/$1');
$routes->get('/formulaire', 'Formulaire::index');

