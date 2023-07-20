<?php
namespace Laventure\Component\Database\Schema\Blueprint\Constraints;


/**
 * @PrimaryKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema\Blueprint\Constraints
*/
class PrimaryKey implements ConstraintInterface
{


    /**
     * @param string|array $columns
    */
    public function __construct(protected string|array $columns)
    {

    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return "PRIMARY KEY (". join(',', (array)$this->columns) . ")";
    }
}