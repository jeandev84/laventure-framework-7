<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column;

/**
 * @inheritdoc
*/
class ModifyColumn extends Column
{

       /**
        * @inheritdoc
       */
       public function __construct(string $name, string $constraints = '')
       {
            parent::__construct($name, '', $constraints);
       }





       /**
        * @inheritdoc
       */
       public function __toString(): string
       {
           return join(' ', [
              "MODIFY COLUMN",
              parent::__toString()
           ]);
      }
}