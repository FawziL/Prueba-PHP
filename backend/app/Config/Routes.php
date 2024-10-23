<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('api/personas', 'PersonaController::getAll');        // Obtener todas las api/personas

$routes->get('api/personas/(:num)', 'PersonaController::getByID/$1'); // Obtener una persona específica por ID

$routes->post('api/personas', 'PersonaController::create');      // Crear una nueva persona

$routes->put('api/personas/(:num)', 'PersonaController::update/$1'); // Actualizar una persona existente

$routes->delete('api/personas/(:num)', 'PersonaController::delete/$1'); // Eliminar una persona

// rutas front

$routes->get('/', 'Home::index'); 

$routes->get('/(:any)', 'Home::index');
