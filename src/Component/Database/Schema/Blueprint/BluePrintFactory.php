<?php
namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\Drivers\MysqlBlueprint;

class BluePrintFactory
{
       public static function make(ConnectionInterface $connection, string $table): Blueprint
       {
             return new MysqlBlueprint($connection, $table);
       }
}