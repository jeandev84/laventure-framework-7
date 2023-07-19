<?php
namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Delete;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Insert;
use Laventure\Component\Database\Builder\SQL\Commands\DML\Update;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Select;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * @SqlQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL
*/
interface SqlQueryBuilderInterface
{


      /**
       * Select records
       *
       * @param string|null $selects
       *
       * @param array $wheres
       *
       * @return Select
     */
     public function select(string $selects = null, array $wheres = []): Select;






     /**
      * Insert records
      *
      * @param array $attributes
      *
      * @return Insert
     */
     public function insert(array $attributes): Insert;







     /**
      * Update record
      *
      * @param array $attributes
      *
      * @param array $wheres
      *
      * @return Update
     */
     public function update(array $attributes, array $wheres = []): Update;






     /**
      * @param array $wheres
      *
      * @return Delete
     */
     public function delete(array $wheres = []): Delete;






     /**
      * Returns table
      *
      * @return string
     */
     public function getTable(): string;







     /**
      * @return ConnectionInterface
     */
     public function getConnection(): ConnectionInterface;
}