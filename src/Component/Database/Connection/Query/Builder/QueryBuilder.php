<?php
namespace Laventure\Component\Database\Connection\Query\Builder;


use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DQL\Select;
use Laventure\Component\Database\Connection\Query\Builder\SQL\SqlQueryBuilder;
use Laventure\Component\Database\Connection\Query\Builder\SQL\SqlQueryBuilderInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;


/**
 * @QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Builder
*/
class QueryBuilder
{

      /**
       * @var SqlQueryBuilderInterface
      */
      protected SqlQueryBuilderInterface $builder;




     /**
      * @param ConnectionInterface $connection
      *
      * @param string $table
     */
     public function __construct(ConnectionInterface $connection, string $table)
     {
          $this->builder = new SqlQueryBuilder($connection, $table);
     }







    /**
     * Select records
     *
     * @param string|null $selects
     *
     * @param bool $distinct
     *
     * @return Select
    */
    public function select(string $selects = null, bool $distinct = false): Select
    {
         return $this->builder->select($selects)->distinct($distinct);
    }







    /**
     * Insert records
     *
     * @param array $attributes
     *
     * @return bool
    */
    public function insert(array $attributes): bool
    {
         return $this->builder->insert($attributes)->execute();
    }








    /**
     * Update record
     *
     * @param array $attributes
     *
     * @param array $wheres
     *
     * @return bool
    */
    public function update(array $attributes, array $wheres): bool
    {
         return $this->builder->update($attributes)
                              ->criteria($wheres)
                              ->execute();
    }








    /**
     * @param array $wheres
     *
     * @return bool
    */
    public function delete(array $wheres): bool
    {
         return $this->builder->delete()
                              ->criteria($wheres)
                              ->execute();
    }
}