<?php

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();



# UPDATE

$qb = new \Laventure\Component\Database\Builder\SQL\Commands\DML\Update($connection, 'users');

$qb->attributes([
    'name' => 'jeanyao@ymail.com',
    'password' => md5('php'),
    'ebook' => 'Advanced PHP Framework'
]);

$qb->where('id = :id')
    ->andWhere('demo = :demo')
;

$qb->setParameters([
    'id' => 2,
    'demo' => sha1('something')
]);

dd($qb->getSQL());

