<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('personas', 'PersonaController::getAll');        // Obtener todas las personas

$routes->get('personas/(:num)', 'PersonaController::getByID/$1'); // Obtener una persona específica por ID

$routes->post('personas', 'PersonaController::create');      // Crear una nueva persona

$routes->put('personas/(:num)', 'PersonaController::update/$1'); // Actualizar una persona existente

$routes->delete('personas/(:num)', 'PersonaController::delete/$1'); // Eliminar una persona