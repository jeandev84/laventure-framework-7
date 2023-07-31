<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\Expr\Utility;


/**
 * @Func
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\Expr\Utility
*/
class Func
{


    /**
     * @param string $function
    */
    public function __construct(protected string $function)
    {
    }


    /**
     * @return string
    */
    public function __toString(): string
    {
         return $this->function;
    }
}