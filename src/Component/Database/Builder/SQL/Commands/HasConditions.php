<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;

/**
 * @SQlBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
trait HasConditions
{

     /**
      * @var array
     */
     protected array $wheres = [];





     /**
      * @param string $condition
      *
      * @return $this
     */
     public function where(string $condition): static
     {
         return $this->andWhere($condition);
     }




     /**
      * @param string $condition
      *
      * @return $this
     */
     public function andWhere(string $condition): static
     {
         $this->wheres['AND'][] = $condition;

         return $this;
     }




     /**
      * @param string $condition
      *
      * @return $this
     */
     public function orWhere(string $condition): static
     {
         $this->wheres['OR'][] = $condition;

         return $this;
     }






     /**
      * @return string
     */
     private function whereSQL(): string
     {
          if (! $this->wheres) {
              return '';
          }

          $wheres = [];

          $key = key($this->wheres);

          foreach ($this->wheres as $operator => $conditions) {

              if ($key !== $operator) {
                  $wheres[] = $operator;;
              }

              $wheres[] = implode(" $operator ", $conditions);
          }

          return sprintf('WHERE %s', join(' ', $wheres));
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