<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column\Drivers;

use Laventure\Component\Database\Schema\Blueprint\Column\Column;
use Laventure\Component\Database\Schema\Blueprint\Column\HasIncrementation;

/**
 * @inheritdoc
*/
class SqliteColumn extends Column implements HasIncrementation
{
       /**
        * @return $this
       */
       public function autoincrement(): static
       {
           return $this->add("AUTOINCREMENT");
       }
}