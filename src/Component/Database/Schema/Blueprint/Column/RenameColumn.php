<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column;

use Laventure\Component\Database\Schema\Blueprint\Column\Contract\AlteredColumnInterface;


/**
 * @inheritdoc
*/
class RenameColumn extends Column implements AlteredColumnInterface
{

      /**
       * @var string
      */
      protected string $to;



      /**
       * @inheritdoc
      */
      public function __construct(string $name, string $to, string $constraints = '')
      {
           parent::__construct($name, '', $constraints);
           $this->to = $to;
      }






      /**
       * @inheritdoc
      */
      public function __toString(): string
      {
           return join(' ', [
               "RENAME COLUMN",
               parent::__toString(),
               "TO {$this->to}"
           ]);
      }

}