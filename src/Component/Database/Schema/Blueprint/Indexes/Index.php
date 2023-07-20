<?php
namespace Laventure\Component\Database\Schema\Blueprint\Indexes;

use Laventure\Component\Database\Schema\Blueprint\Printable;



/**
 * @inheritdoc
*/
class Index implements Printable
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
        return "INDEX(". join(',', (array)$this->columns) . ")";
    }
}