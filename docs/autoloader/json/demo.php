<?php

require_once __DIR__ . '/src/SplAutoloader.php';

/*
$autoloader = new SplAutoloader(__DIR__);

$autoloader->addNamespaces([
  'Laventure\\' => 'src/',
  'App\\' => 'app/'
]);


$autoloader->register();
*/

SplAutoloader::load(__DIR__);

$cache = new \Laventure\Component\Templating\Template\Cache\TemplateCache(__DIR__.'/storage/cache');
$controller = new \App\Controller\HelloController();

print_r($cache);
print_r($controller);
