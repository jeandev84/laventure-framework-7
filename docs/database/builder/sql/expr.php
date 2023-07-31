<?php

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();


$qb = \Laventure\Component\Database\Connection\Query\Builder\QueryBuilderFactory::make($connection, 'users');

$qb = $qb->select();
$qb->from('users', 'u');

/*
$qb->where($qb->expr()->eq('id', ':id'))
   ->andWhere($qb->expr()->like('name', ':name'));
*/

$qb->where(
    $qb->expr()->andX(
        $qb->expr()->like('u.username', ':username'),
        $qb->expr()->like('u.email', ':email'),
        $qb->expr()->like('u.phoneNumber', ':phoneNumber'),
    )
);

$qb->andWhere($qb->expr()->isNull('u.deleted_at'));
$qb->orWhere($qb->expr()->isNotNull('u.active'));
$qb->andWhere($qb->expr()->in('u.id', '(:ids)'));


$username    = 'john';
$email       = 'john@doe.com';
$phoneNumber = '7 900 800 74 56';

$ids = [16373, 24567, 3947,49883];

$qb->setParameters([
    'username' => '%'. $username . '%',
    'email' => '%'. $email . '%',
    'phoneNumber' => '%'. $phoneNumber . '%',
    'ids' => $ids
]);

dd($qb->getSQL());

/*
SELECT * FROM users u
WHERE u.username LIKE :username
AND u.email LIKE :email
AND u.phoneNumber LIKE :phoneNumber
AND u.deleted_at IS NULL
AND u.id IN (:ids)
OR u.active IS NOT NULL;
*/