<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Contract\DeleteBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Contract\InsertBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Delete;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Insert;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Update;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DQL\Contract\SelectBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DQL\Select;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * @SqlQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Builder\SQL
*/
interface SqlQueryBuilderInterface
{


      /**
       * Select records
       *
       * @param string $selects
       *
       * @return Select
     */
     public function select(string $selects): Select;






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
      * @return Update
     */
     public function update(array $attributes): Update;







     /**
      * @return Delete
     */
     public function delete(): Delete;
}