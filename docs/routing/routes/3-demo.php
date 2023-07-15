<?php

use Laventure\Component\Routing\Router;

require_once __DIR__ . '/vendor/Psr4.php';


$router = new Router('http://localhost');
$router->middlewareStack([
    'auth'    => \App\Middleware\AuthenticatedMiddleware::class,
    'guest'   => \App\Middleware\GuestMiddleware::class,
    'session' => \App\Middleware\SessionMiddleware::class
]);

$router->namespace('App\\Controller');


/*
$router->map('GET', '/', function () {
    return 'Welcome';
});


$router->get('/books/{id}/{slug}', [
    \App\Controller\BookController::class,
    'show'
], 'books.show')
->where('id', '\d+')
->slug('slug');



if(! $route = $router->match('GET', 'http://localhost/books/1/this-is-a-new-book')) {
     dd('Route note found');
}

dump($route);
dump($router->generate('books.show', ['id' => 1, 'slug' => 'this-is-a-new-book']));



$prefixes =  [
    'path'   => 'admin',
    'module' => 'Admin',
    'name'   => 'admin.'
];


$router->group($prefixes, function (Router $router) {
   $router->get('/', [UserController::class, 'index'], 'users.list');
   $router->get('/{id}', [UserController::class, 'show'], 'users.show')
          ->number('id');

   $router->resource('books', \App\Controller\Admin\BookController::class);
});


$router->get('/', function () {
    return 'Welcome!';
});

*/


$prefixes =  [
    'path'   => 'api/v1/',
    'name'   => 'api.v1.'
];

$router->group($prefixes, function (Router $router) {
    $router->apiResource('cart', \App\Controller\Api\v1\CartController::class);
});


if (! $route = $router->match('GET', '/api/v1/cart')) {
    dd('Route /api/v1/cart not found');
}


$controller = $route->getController();
$action     = $route->getActionName();

$route->action([new $controller, $action]);

echo $route->callAction();

$router->get('/hello/{id?}', \App\Controller\HelloController::class, 'hello')->where('id', '\d+');

if (! $route = $router->match('GET', '/hello')) {
     dd('Route /hello not found');
}

echo $router->generate('hello', ['id' => 3]) . "\n";

#dd($route);

#dd($router->getRoutes());
