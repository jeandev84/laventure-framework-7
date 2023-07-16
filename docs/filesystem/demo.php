<?php

require_once __DIR__ . '/src/Psr4/Autoloader.php';

Autoloader::load(__DIR__);

/*
$info = new SplFileInfo(__DIR__.'/storage/log/error.log');
echo $info->getPath(), "\n";
*/


/*
$file = new \Laventure\Component\Filesystem\File\File(__DIR__.'/something.txt');

echo $file->make();


$f = new \Laventure\Component\Filesystem\File\File(__DIR__.'/storage/log/something.txt');
*/

$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

/*
var_dump($filesystem->exists('databases/migrations/Version20230716083053.php'));
$filesystem->make('databases/migrations/Version'. date('YmdHis') . '.php');
*/

$file = new \Laventure\Component\Filesystem\File\FileBase64(file_get_contents(__DIR__.'/storage/data/image.txt'));


/*
$filesystem->uploadBase64('public/uploads/test.png', $file);
*/

$config = $filesystem->file('/config/database.php')->loadOnlyArray();

print_r($config);