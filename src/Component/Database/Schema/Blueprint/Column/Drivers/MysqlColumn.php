<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column\Drivers;

use Laventure\Component\Database\Schema\Blueprint\Column\Column;


/**
 * @inheritdoc
*/
class MysqlColumn extends Column
{


    /**
     * @param string $name
     *
     * @param string $type
     *
     * @param string $constraints
    */
    public function __construct(string $name, string $type, string $constraints = '')
    {
        parent::__construct("`$name`", $type, $constraints);
    }
}