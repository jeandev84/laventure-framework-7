<?php
namespace Laventure\Component\Database\Builder;


use Laventure\Component\Database\Builder\SQL\Commands\DQL\Select;
use Laventure\Component\Database\Builder\SQL\SqlQueryBuilder;
use Laventure\Component\Database\Builder\SQL\SqlQueryBuilderInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;


/**
 * @QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder
*/
class QueryBuilder
{

     /**
      * @var SqlQueryBuilderInterface
     */
     protected SqlQueryBuilderInterface $builder;



     /**
      * @param SqlQueryBuilderInterface $builder
     */
     public function __construct(SqlQueryBuilderInterface $builder)
     {
          $this->builder = $builder;
     }





     /**
      * Select records
      *
      * @param string|null $selects
      *
      * @param array $wheres
      *
      * @return Select
    */
    public function select(string $selects = null, array $wheres = []): Select
    {
         return $this->builder->select($selects)->criteria($wheres);
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
    public function update(array $attributes, array $wheres = []): bool
    {
         return $this->builder->update($attributes, $wheres)->execute();
    }








    /**
     * @param array $wheres
     *
     * @return bool
    */
    public function delete(array $wheres = []): bool
    {
         return $this->builder->delete($wheres)->execute();
    }
}