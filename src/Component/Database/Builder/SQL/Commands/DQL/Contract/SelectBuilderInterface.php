<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract;

use Laventure\Component\Database\Connection\Query\QueryResultInterface;

interface SelectBuilderInterface
{

    /**
     * @param bool $distinct
     *
     * @return $this
    */
    public function distinct(bool $distinct): static;




    /**
     * @param string $select
     *
     * @return $this
    */
    public function addSelect(string $select): static;






    /**
     * @param string $table
     *
     * @param string $alias
     *
     * @return $this
    */
    public function from(string $table, string $alias = ''): static;






    /**
     * @param string $column
     *
     * @param string $direction
     *
     * @return $this
    */
    public function orderBy(string $column, string $direction = 'asc'): static;





    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @param string|null $type
    */
    public function join(string $table, string $condition, string $type = null): static;





    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function innerJoin(string $table, string $condition): static;







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function leftJoin(string $table, string $condition): static;







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function rightJoin(string $table, string $condition): static;







    /**
     * @param string $table
     *
     * @param string $condition
     *
     * @return $this
    */
    public function fullJoin(string $table, string $condition): static;







    /**
     * @param string $column
     *
     * @return $this
    */
    public function groupBy(string $column): static;





    /**
     * @param string $condition
     *
     * @return $this
    */
    public function having(string $condition): static;





    /**
     * @param int $limit
     *
     * @return $this
    */
    public function setMaxResults(int $limit): static;






    /**
     * @param int $offset
     *
     * @return $this
    */
    public function setFirstResult(int $offset): static;





    /**
     * Set query hydrate
     *
     * @param QueryResultInterface $hydrate
     *
     * @return $this
    */
    public function hydrate(QueryResultInterface $hydrate): static;





    /**
     * Returns query
     *
     * @return QueryResultInterface
    */
    public function fetch(): QueryResultInterface;






    /**
     * Return
     * @return Query
    */
    public function getQuery(): Query;
}