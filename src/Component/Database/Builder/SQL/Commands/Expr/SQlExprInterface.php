<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\Expr;


/**
 * @SQlExprInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
interface SQlExprInterface
{

      /**
       * @return string
      */
      public function __toString(): string;
}