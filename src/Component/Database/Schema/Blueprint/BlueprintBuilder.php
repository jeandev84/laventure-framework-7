<?php
namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Blueprint\Column\AddColumn;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;
use Laventure\Component\Database\Schema\Blueprint\Column\Contract\AlteredColumnInterface;
use Laventure\Component\Database\Schema\Blueprint\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Blueprint\Indexes\Index;
use Laventure\Component\Database\Schema\Blueprint\Constraints\ForeignKey;


/**
 * @BlueprintBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema\Blueprint
*/
class BlueprintBuilder
{

      /**
       * @var Column[]
      */
      protected array $columns = [];





      /**
       * @var Column[]
      */
      protected array $altered = [];





      /**
       * @var ConstraintInterface[]
      */
      protected array $constraints = [];






      /**
       * @var Index[]
      */
      protected array $indexes = [];






      /**
       * @param Column|AddColumn $column
       *
       * @return Column
      */
      public function addColumn(Column|AddColumn $column): Column
      {
           if ($column instanceof AddColumn) {
               $this->altered[$column->getName()] = $column;
           } else {
               $this->columns[$column->getName()] = $column;
           }

           return $column;
      }





      /**
       * @param ConstraintInterface $constraint
       *
       * @return $this
      */
      public function addConstraint(ConstraintInterface $constraint): static
      {
          $this->constraints[] = $constraint;

           return $this;
      }





      /**
       * @param Index $index
       *
       * @return $this
      */
      public function addIndex(Index $index): static
      {
          $this->indexes[] = $index;

          return $this;
      }




      /**
       * @param ForeignKey $foreign
       *
       * @return ForeignKey
      */
      public function addForeignKey(ForeignKey $foreign): ForeignKey
      {
           $this->addConstraint($foreign);

           return $foreign;
      }





      /**
       * Returns columns
       *
       * @return Column[]
      */
      public function getColumns(): array
      {
           return $this->columns;
      }






      /**
       * @return string
      */
      public function printNewColumns(): string
      {
           return join([
               join(", ", array_values($this->getColumns())),
               join(", ", array_values($this->constraints)),
               join(", ", array_values($this->indexes))
           ]);
      }





      /**
       * @return string
      */
      public function printAlteredColumns(): string
      {
          return join(", ", array_values($this->altered));
      }
}