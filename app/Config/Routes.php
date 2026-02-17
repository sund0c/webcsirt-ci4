<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
#$routes->get('/', 'Home::index');


$routes->setAutoRoute(false);

$routes->get('/', function () {
    return view('public/home', ['title' => 'Beranda']);
});

$routes->get('/advisory', 'Advisory::index');


$routes->group('portal-internal-x83fj9', function ($routes) {
    $routes->get('login', 'Internal\Auth::login');
    $routes->post('attempt', 'Internal\Auth::attempt');
    $routes->get('logout', 'Internal\Auth::logout');
    $routes->get('dashboard', 'Internal\Dashboard::index', ['filter' => 'adminauth']);
});

$routes->group('portal-internal-x83fj9', ['filter' => 'adminauth'], function ($routes) {

    $routes->get('articles', 'Internal\Articles::index');
    $routes->get('articles/create', 'Internal\Articles::create');
    $routes->post('articles/store', 'Internal\Articles::store');
    $routes->get('articles/edit/(:num)', 'Internal\Articles::edit/$1');
    $routes->post('articles/update/(:num)', 'Internal\Articles::update/$1');
    $routes->get('articles/delete/(:num)', 'Internal\Articles::delete/$1');
    $routes->get('articles/trash', 'Internal\Articles::trash');
    $routes->get('articles/restore/(:num)', 'Internal\Articles::restore/$1');

    $routes->get('advisories', 'Internal\Advisories::index');
    $routes->get('advisories/create', 'Internal\Advisories::create');
    $routes->post('advisories/store', 'Internal\Advisories::store');
    $routes->get('advisories/edit/(:num)', 'Internal\Advisories::edit/$1');
    $routes->post('advisories/update/(:num)', 'Internal\Advisories::update/$1');
    $routes->get('advisories/delete/(:num)', 'Internal\Advisories::delete/$1');
    $routes->get('advisories/trash', 'Internal\Advisories::trash');
    $routes->get('advisories/restore/(:num)', 'Internal\Advisories::restore/$1');

    $routes->get('pages', 'Internal\Pages::index');
    $routes->get('pages/create', 'Internal\Pages::create');
    $routes->post('pages/store', 'Internal\Pages::store');
    $routes->get('pages/edit/(:num)', 'Internal\Pages::edit/$1');
    $routes->post('pages/update/(:num)', 'Internal\Pages::update/$1');
    $routes->get('pages/delete/(:num)', 'Internal\Pages::delete/$1');
    $routes->get('pages/trash', 'Internal\Pages::trash');
    $routes->get('pages/restore/(:num)', 'Internal\Pages::restore/$1');
    $routes->post('pages/upload-image', 'Internal\Pages::uploadImage');

    $routes->get('guides', 'Internal\Guides::index');
    $routes->get('guides/create', 'Internal\Guides::create');
    $routes->post('guides/store', 'Internal\Guides::store');
    $routes->get('guides/edit/(:num)', 'Internal\Guides::edit/$1');
    $routes->post('guides/update/(:num)', 'Internal\Guides::update/$1');
    $routes->get('guides/delete/(:num)', 'Internal\Guides::delete/$1');
    $routes->get('guides/trash', 'Internal\Guides::trash');
    $routes->get('guides/restore/(:num)', 'Internal\Guides::restore/$1');
    $routes->get('guides/preview/(:num)', 'Internal\Guides::preview/$1');
});


$routes->get('image/articles/(:any)', 'Internal\Articles::image/$1');
$routes->get('image/advisories/(:any)', 'Internal\Advisories::image/$1');



$routes->get('(:segment)', 'Page::show/$1');
