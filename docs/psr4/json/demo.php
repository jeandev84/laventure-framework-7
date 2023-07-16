<?php

require_once __DIR__ . '/src/Psr4/Autoloader.php';

/*
$psr4 = new Autoloader(__DIR__);

$psr4->addNamespaces([
  'Laventure\\' => 'src/',
  'App\\' => 'app/'
]);


$psr4->register();
*/

Autoloader::load(__DIR__);

$cache = new \Laventure\Component\Templating\Template\Cache\TemplateCache(__DIR__.'/storage/cache');
$controller = new \App\Controller\HelloController();

print_r($cache);
print_r($controller);
