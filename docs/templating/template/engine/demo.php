<?php

use Laventure\Component\Templating\Template\Cache\TemplateCache;
use Laventure\Component\Templating\Template\Template;

require_once __DIR__ . '/../vendor/autoload.php';


/*
$template = new Template(__DIR__.'/../templates/demo/index.html', [
    'title' => 'Вход'
]);


foreach ($blocks as $name => $content) {
     $layout = preg_replace("/{% ?block ?(?P<$name>(.*?)) ?%}(.*?){% ?endblock ?%}/is", $content, $layout);
}

echo $layout;

$subject = file_get_contents(__DIR__.'/views/index.html');

$users = [
    new \App\Entity\User('demo1@test.com', md5(123)),
    new \App\Entity\User('demo2@test.com', md5(123)),
    new \App\Entity\User('demo3@test.com', md5(123)),
];

$subject = preg_replace('/@loop((.*)\s*as\s*(.*)):/', '<?php foreach ($users as $user)?>', $subject);
$subject = preg_replace('/{{\s*(.*)\s*}}/', '<?= $$1 ?>', $subject);
$subject = preg_replace('/@endloop/', '<?php endforeach; ?>', $subject);

dd($subject);
*/

# Template
$template = new Template(__DIR__.'/../templates/twig/index.html', [
    'title' => 'Вход',
    'users' => [
        new \App\Entity\User('demo1@test.com', md5(123)),
        new \App\Entity\User('demo2@test.com', md5(123)),
        new \App\Entity\User('demo3@test.com', md5(123)),
    ]
]);


# Template engine
$engine = new \Laventure\Component\Templating\Template\Engine\TemplateEngine(__DIR__.'/../templates/twig');

$content = $engine->compile($template);

$cache = new TemplateCache(__DIR__.'/../storage/cache/views');
$cache->cache('index.html', $content);
