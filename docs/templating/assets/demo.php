<?php

use Laventure\Component\Templating\Renderer\Renderer;
use Laventure\Component\Templating\Template\Cache\TemplateCache;
use Laventure\Component\Templating\Template\Layout\Layout;
use Laventure\Component\Templating\Template\Template;

require_once __DIR__ . '/../vendor/autoload.php';


/*
$template = new Template(__DIR__.'/templates/views/contact.html', [
    'title' => 'Вход'
]);


$layout = new Layout(__DIR__.'/templates/views/layouts/default.html', $template);

dump($layout->getPath());

echo $layout, "\n";

dump($layout->getTemplate()->getPath());

*/

$asset = new \Laventure\Component\Templating\Asset\Asset('http://localhost:8000');


$asset->css([
   'assets/css/app.css'
]);

$asset->js([
    'assets/js/app.js'
]);

/*
$renderer = new Renderer(__DIR__.'/../templates/views/');
$renderer->cache(new TemplateCache(__DIR__.'/../storage/cache/views'));
$renderer->setTags([
    '{% javascript %}'   => $asset->renderScripts(),
    '{% stylesheets %}'  => $asset->renderStyles()
]);

$renderer->setGlobals([
  'app_name' => 'Laventure'
]);

$renderer->layoutPath('layouts/default.html');

echo $renderer->render('login.html'), "\n";
*/