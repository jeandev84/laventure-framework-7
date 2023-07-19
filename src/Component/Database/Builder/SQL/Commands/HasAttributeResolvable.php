<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;

/**
 * @HasAttributeResolvable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
trait HasAttributeResolvable
{


      /**
       * @param ConnectionInterface $connection
       *
       * @param array $attributes
       *
       * @return array
      */
      protected function resolveAttributes(ConnectionInterface $connection, array $attributes): array
      {
            $resolved = [];

            foreach ($attributes as $column => $value) {
                 if ($connection instanceof PdoConnection) {
                     $resolved[] = "$column = :$column";
                 } else {
                     $resolved[] = "$column = ". $this->resolveAttributeValue($value);
                 }
            }

            return $resolved;
      }




      /**
       * @param $value
       *
       * @return string
      */
      protected function resolveAttributeValue($value): string
      {
           return "'$value'";
      }
}