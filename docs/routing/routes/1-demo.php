<?php

require_once __DIR__.'/../vendor/Psr4.php';


$prefixes =  [
    'path' => 'admin',
    'namespace' => 'App\\Controller\\Admin\\',
    'name' => 'admin.'
];


$route1 = new \Laventure\Component\Routing\Route\Route($prefixes);

$route1->domain('http://localhost');
$route1->path('/');
$route1->methods(['GET']);
$route1->action(function () {
   return 'Hello world!';
});


/* dd($route1); */

$route2 = new \Laventure\Component\Routing\Route\Route();
$route2->methods('GET');
$route2->path('/books/{id}/{slug}');
$route2->where('id', '\d+');
$route2->slug('slug');
$route2->action([\App\Controller\BookController::class, 'show']);


if($route2->match('GET', 'http://localhost/books/1/this-is-a-new-book')) {
     dd($route2->getParams());
}

dd($route2->generateUri(['id' => 1, 'slug' => 'this-is-a-new-book']));


