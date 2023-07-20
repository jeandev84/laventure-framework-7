<?php
namespace Laventure\Component\Database\Schema\Blueprint\Constraints;



/**
 * @inheritdoc
*/
class Unique implements ConstraintInterface
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
        return "UNIQUE(". join(',', (array)$this->columns) . ")";
    }
}