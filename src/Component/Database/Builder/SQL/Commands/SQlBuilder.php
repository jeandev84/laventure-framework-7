<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Connection\ConnectionInterface;

abstract class SQlBuilder
{


      /**
       * @param ConnectionInterface $connection
       *
       * @param string $table
      */
      public function __construct(protected ConnectionInterface $connection, protected string $table)
      {
      }




      /**
       * @return mixed
      */
      abstract public function getSQL();
}