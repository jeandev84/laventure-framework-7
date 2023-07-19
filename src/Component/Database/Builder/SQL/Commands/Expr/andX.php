<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\Expr;

/**
 * @Expr
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\Expr
*/
class andX implements SQlExprInterface
{

     /**
      * @var array
     */
     protected array $conditions = [];




     /**
      * @param array $conditions
     */
     public function __construct(array $conditions)
     {
          $this->conditions = $conditions;
     }





     /**
      * @return string
     */
     public function __toString(): string
     {
         return join("AND", $this->conditions);
     }
}