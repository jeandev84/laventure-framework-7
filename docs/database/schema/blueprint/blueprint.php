<?php

use Laventure\Component\Database\Schema\Blueprint\Column\Column;

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();

$blueprint = new \Laventure\Component\Database\Schema\Blueprint\Drivers\MysqlBlueprint($connection, 'users');


$blueprint->increments('id');
$blueprint->string('username', 260);
$blueprint->string('password', 300);
$blueprint->boolean('active')->default(0);
$blueprint->timestamps();

$blueprint->createTable();

# $blueprint->dropTableIfExists();


