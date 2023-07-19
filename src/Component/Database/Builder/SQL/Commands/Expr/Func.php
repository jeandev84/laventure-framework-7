<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\Expr;


use Laventure\Component\Database\Builder\SQL\Commands\Expr\Contract\SQlExprInterface;

/**
 * @Func
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\Expr
*/
class Func implements SQlExprInterface
{


    /**
     * @param string $function
    */
    public function __construct(protected string $function)
    {
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
         return $this->function;
    }
}