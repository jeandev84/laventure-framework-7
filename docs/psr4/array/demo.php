<?php
require_once __DIR__ . '/src/Psr4/Autoloader.php';

$autoloader = new Autoloader(__DIR__);

$autoloader->addNamespaces([
  'Laventure\\' => 'src/',
  'App\\' => 'app/'
]);


$autoloader->register();


$cache = new \Laventure\Component\Templating\Template\Cache\TemplateCache(__DIR__.'/storage/cache');
$controller = new \App\Controller\HelloController();

print_r($cache);
print_r($controller);
