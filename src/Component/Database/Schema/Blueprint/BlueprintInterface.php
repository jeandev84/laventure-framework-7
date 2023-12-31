<?php
namespace Laventure\Component\Database\Schema\Blueprint;


/**
 * @BlueprintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema\Blueprint
*/
interface BlueprintInterface
{


       /**
        * Returns table name
        *
        * @return string
       */
       public function getTable(): string;






       /**
        * Returns table columns
        *
        * @return array
       */
       public function getTableColumns(): array;






       /**
        * Create table
        *
        * @return mixed
       */
       public function createTable(): mixed;





       /**
        * Update table
        *
        * @return mixed
       */
       public function updateTable(): mixed;







       /**
        * Drop table
        *
        * @return mixed
       */
       public function dropTable(): mixed;






       /**
        * Drop table if exists
        *
        * @return mixed
       */
       public function dropTableIfExists(): mixed;





       /**
        * Truncate table
        *
        * @return mixed
       */
       public function truncateTable(): mixed;





      /**
       * Truncate table cascade
       *
       * @return mixed
      */
      public function truncateTableCascade(): mixed;





      /**
       * Describe table
       *
       * @return mixed
      */
      public function describeTable(): mixed;
}