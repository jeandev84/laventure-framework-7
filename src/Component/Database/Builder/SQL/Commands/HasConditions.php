<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


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
          return '';
     }
}