<?php

use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DQL\Select;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();





/*

$qb = new Select($connection, 'users u', '*');
$qb = $qb->where('u.active = :active')
   ->setParameter('active', 1);

# dd($qb->fetch()->assoc());


$qb = new Select($connection, 'users u');
$sql = $qb->distinct(true)
          ->addSelect('o.id, o.invoiceNumber, o.user_id')
          ->join('orders o', 'orders.id = u.order_id')
          ->leftJoin('books b', 'books.id = u.book_id')
          ->rightJoin('tweets t', 'tweets.id = u.tweet_id')
          ->innerJoin('cart c', 'cart.id = u.cart_id')
          ->fullJoin('order_item oi', 'oi.id = o.order_item_id')
          ->addSelect('u.id, u.username, u.email, u.address')
          ->from('users', 'u')
          ->where('u.id = :id')
          ->where('o.id = :orderId')
          ->orWhere('c.id = :cartId')
          ->andWhere('oi.id = :oderItemId')
          ->orderBy('u.id', 'desc')
          ->setFirstResult(1)
          ->setMaxResults(10)
          ->setParameter('id', 1)
          ->groupBy('c.id as cart')
          ->having('count(c.id) > 5')
;

$qb = $qb->distinct(true)
         ->from('users', 'u')
         ->criteria([
             'username' => 'john@brown.ru',
             'id' => [1, 2, 3, 4]
         ])
         ->orderBy('u.id', 'desc');

dd($qb->getSQL());

$qb = new \Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Insert($connection, 'users');


/*
$qb->attributes([
    'username' => 'john 1',
    'password' => md5(1),
    'active'   => 1,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]);

$qb->attributes([
    [
        'username' => 'john 1',
        'password' => md5(1),
        'active'   => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
    [
        'username' => 'john 2',
        'password' => md5(1),
        'active'   => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ],
]);

$qb->execute();


$qb = new \Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Update($connection, 'users');

$qb->attributes([
    'username' => 'test',
    'active' => 0
]);

$qb->where('id = :id')
   ->setParameter('id', 2)
   ->execute()
;
*/


$qb = new \Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Delete($connection, 'users');

# $qb->expr()->eq('id', ':id');
$qb->where('id = :id')
    ->setParameter('id', 2)
    ->execute()
;


