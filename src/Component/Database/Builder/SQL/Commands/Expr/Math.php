<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\Expr;


/**
 * @Math
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\Expr
*/
class Math
{


    /**
     * @param string $x
     *
     * @param string $operator
     *
     * @param string $y
    */
    public function __construct(protected string $x, protected string $operator, protected string $y)
    {
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
         return sprintf('%s %s %s', $this->x, $this->operator, $this->y);
    }
}