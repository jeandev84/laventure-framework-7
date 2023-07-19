<?php

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();



# INSERT

$qb = new \Laventure\Component\Database\Builder\SQL\Commands\DML\Insert($connection, 'users');


$qb->attributes([
    'name' => 'jeanyao@ymail.com',
    'password' => md5('php'),
    'ebook' => 'Advanced PHP Framework'
]);

$qb->attributes([
    'name' => 'jeanyao@ymail.com',
    'password' => md5('php'),
    'ebook' => 'Advanced PHP Framework'
]);

$qb->attributes([
    'name' => 'jeanyao@ymail.com',
    'password' => md5('php'),
    'ebook' => 'Advanced PHP Framework'
]);



/*
dd($qb->getSQL());
INSERT INTO users (name, password, ebook) VALUES (:name_0, :password_0, :ebook_0), (:name_1, :password_1, :ebook_1), (:name_2, :password_2, :ebook_2);
*/


$qb->attributes([
    [
        'name' => 'jeanyao@ymail.com',
        'password' => md5('php'),
        'ebook' => 'Advanced PHP Framework'
    ],
    [
        'name' => 'jeanyao@ymail.com',
        'password' => md5('php'),
        'ebook' => 'Advanced PHP Framework'
    ]
]);



/*
dd($qb->getSQL());
INSERT INTO users (name, password, ebook) VALUES (:name_0, :password_0, :ebook_0), (:name_1, :password_1, :ebook_1);
*/