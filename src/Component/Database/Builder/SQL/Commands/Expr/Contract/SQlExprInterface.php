<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\Expr\Contract;

/**
 * @SQlExprInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\Expr\Contract
*/
interface SQlExprInterface
{
       /**
        * Returns expression string
        *
        * @return string
       */
       public function __toString(): string;
}