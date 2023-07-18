<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Connection\ConnectionInterface;


/**
 * @SQlBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
abstract class SQlBuilder
{

       /**
        * @var ConnectionInterface
       */
       protected ConnectionInterface $connection;



       /**
        * @var string
       */
       protected string $table;




       /**
        * @var array
       */
       protected array $parameters = [];



      /**
       * @param ConnectionInterface $connection
       *
       * @param string $table
      */
      public function __construct(ConnectionInterface $connection, string $table)
      {
            $this->connection = $connection;
            $this->table      = $table;
      }




      /**
       * @return string
      */
      public function getTable(): string
      {
          return $this->table;
      }




      /**
       * @param string $name
       *
       * @param $value
       *
       * @return $this
      */
      public function setParameter(string $name, $value): static
      {
           $this->parameters[$name] = $value;

           return $this;
      }





      /**
       * @param array $parameters
       *
       * @return SQlBuilder
      */
      public function setParameters(array $parameters): static
      {
           $this->parameters = array_merge($this->parameters, $parameters);

           return $this;
      }





      /**
       * Returns parameters
       *
       * @return array
      */
      public function getParameters(): array
      {
           return $this->parameters;
      }



      /**
       * @return string
      */
      abstract public function getSQL(): string;
}