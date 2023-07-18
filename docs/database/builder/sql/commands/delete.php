<?php

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();


# DELETE
$qb = new \Laventure\Component\Database\Builder\SQL\Commands\DML\Delete($connection, 'users');

$qb->where('id = :id')
    ->setParameter('id', 3)
;

dd($qb->getSQL());