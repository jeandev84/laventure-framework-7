<?php

use Laventure\Component\Database\Schema\Blueprint\Column\Column;

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();

/*
$migrator = new \Laventure\Component\Database\Migration\Migrator($connection);

#dd($migrator);

$version = 'Version'.date('YmdHis');
$filesystem->write("app/Migration/{$version}.php", '');
*/



