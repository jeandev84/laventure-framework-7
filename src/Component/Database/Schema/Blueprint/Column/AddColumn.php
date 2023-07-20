<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column;



/**
 * @inheritdoc
*/
class AddColumn extends Column
{

      /**
       * @inheritdoc
      */
      public function __toString(): string
      {
           return join(' ', [
              "ADD COLUMN",
              parent::__toString()
           ]);
      }
}