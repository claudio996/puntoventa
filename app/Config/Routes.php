<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Categorias');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Categorias::index');

$routes->group('categorias', function ($routes) {

    $routes->get('/', 'Categorias::index');
    $routes->get('create', 'Categorias::create');
    $routes->post('store', 'Categorias::store');
    $routes->get('edit/(:any)', 'Categorias::edit/$1');
    $routes->post('update', 'Categorias::update');
    $routes->delete('delete/(:any)', 'Categorias::delete/$1');
});

$routes->group('productos' ,function($routes){
	$routes->get('/', 'Productos::index');
	$routes->get('create', 'Productos::create');
	$routes->get('edit', 'Productos::edit');

});

$routes->group('compras' ,function($routes){
	$routes->get('/', 'Compras::index');
	$routes->get('create', 'Compras::create');
	$routes->get('buscarCodigo/(:any)', 'TemporalCompra::buscarCodigo/$1');
	$routes->get('temporalInsertar/(:any)', 'TemporalCompra::temporalCompra/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
