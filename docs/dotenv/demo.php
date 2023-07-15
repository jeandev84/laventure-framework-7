<?php


require_once __DIR__ . '/vendor/Psr4.php';


$dotenv = new \Laventure\Component\Dotenv\Dotenv(__DIR__);

$dotenv->load();

echo getenv('DB_PASS'), "\n";

