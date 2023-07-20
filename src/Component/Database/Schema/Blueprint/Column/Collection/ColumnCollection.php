<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column;

class ColumnCollection
{

      /**
       * @var Column[]
      */
      protected array $columns = [];



      /**
       * @param Column $column
       *
       * @return Column
      */
      public function addColumn(Column $column): Column
      {
          $this->columns[$column->getName()] = $column;

          return $column;
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
}