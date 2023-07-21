<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnectionInterface;


/**
 * @SQlParameterResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
class SQlParameterResolver
{

       /**
        * @var ConnectionInterface
       */
       protected ConnectionInterface $connection;




       /**
        * @param ConnectionInterface $connection
       */
       public function __construct(ConnectionInterface $connection)
       {
            $this->connection = $connection;
       }





       /**
        * @return bool
       */
       public function hasPdoConnection(): bool
       {
            return $this->connection instanceof PdoConnectionInterface;
       }




        /**
         * @param array $attributes
         *
         * @return array
        */
        public function resolveAttributes(array $attributes): array
        {
              $resolved = [];

              foreach ($attributes as $column => $value) {
                 if ($this->hasPdoConnection()) {
                    $resolved[] = "$column = :$column";
                 } else {
                    $resolved[] = "$column = '$value'";
                 }
             }

             return $resolved;
        }




       /**
        * @param array $wheres
        *
        * @param bool $pdo
       */
       private function addConditions(array $wheres, bool $pdo = false): void
       {
           foreach ($wheres as $column => $value) {
            if ($pdo) {
                $this->where("$column = :$column");
            } else {
                $this->where("$column = ". $this->resolveConditionValue($value));
            }
          }
    }






    /**
     * @param $value
     *
     * @return string
     */
    protected function resolveConditionValue($value): string
    {
        return "'$value'";
    }

}