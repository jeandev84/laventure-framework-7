<?php

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);


/** Connection */
$connection = $manager->connection();
# $connection->disconnect();
# $connection->reconnect();

dump($connection->getConnection());


/** Database */
$connection->createDatabase();
$databases  = $connection->getDatabases();
$status     = $manager->connection()->hasDatabase();

dump($databases);
dd($status);


/*
$connection->disconnect();
$connection->reconnect();

dd($connection->getConnection());

$connection->createDatabase();
$databases  = $connection->getDatabases();
$status     = $manager->connection()->hasDatabase();

dump($databases);
dd($status);
*/