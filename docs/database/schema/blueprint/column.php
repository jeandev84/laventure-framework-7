<?php

use Laventure\Component\Database\Schema\Blueprint\Column\Column;

require_once __DIR__ . '/vendor/autoload.php';


$filesystem = new \Laventure\Component\Filesystem\Filesystem(__DIR__);

$config = $filesystem->load('config/database.php');


$manager = new \Laventure\Component\Database\Manager();
$manager->addConnections($config);

$connection = $manager->connection();


$id = new Column('id', 'INT');
$id->primaryKey();
echo $id, "\n";


$name = new Column('name', 'VARCHAR(255)');
$name->nullable();
$name->default('Joe');
echo $name, "\n";

