<?php

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();



/*
// Connection
$connection->disconnect();
dump($connection->getConnection());
$connection->reconnect();
dump($connection->getConnection());

$connection->createDatabase();
$databases  = $connection->getDatabases();
$status     = $manager->connection()->hasDatabase();
dump($databases);
dd($status);
*/


// QueryBuilder

/*
# SELECT
$qb = new \Laventure\Component\Database\Builder\SQL\Commands\DQL\Select($connection, 'users u');

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
          ->criteria([])
          ->setFirstResult(1)
          ->setMaxResults(10)
          ->setParameter('id', 1)
          ->groupBy('c.id')
          ->having('count(c.id) > 5')
;


dd($qb->getSQL());

=============================================================================================
SELECT DISTINCT o.id, o.invoiceNumber, o.user_id, u.id, u.username, u.email, u.address
FROM users u
JOIN orders o ON orders.id = u.order_id
LEFT JOIN books b ON books.id = u.book_id
RIGHT JOIN tweets t ON tweets.id = u.tweet_id
INNER JOIN cart c ON cart.id = u.cart_id FULL
JOIN order_item oi ON oi.id = o.order_item_id
WHERE u.id = :id AND o.id = :orderId AND oi.id = :oderItemId OR c.id = :cartId
GROUP BY c.id HAVING count(c.id) > 5
ORDER BY u.id DESC
LIMIT 10 OFFSET 1;


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

=======================================================================================================
UPDATE users SET name = :name, password = :password, ebook = :ebook WHERE id = :id AND demo = :demo;

# DELETE
$qb = new \Laventure\Component\Database\Builder\SQL\Commands\DML\Delete($connection, 'users');

$qb->where('id = :id')
   ->setParameter('id', 3)
;

dd($qb->getSQL());


"DELETE FROM users WHERE id = :id;"
*/

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