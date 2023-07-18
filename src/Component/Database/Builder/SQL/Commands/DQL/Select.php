<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;


use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\Query;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\HasConditions;
use Laventure\Component\Database\Builder\SQL\Commands\SQlBuilder;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;


/**
 * @inheritdoc
*/
class Select extends SQlBuilder implements SelectBuilderInterface
{


    use HasConditions;


    /**
     * @var string[]
    */
    protected $selected = [];



    /**
     * @var int
     */
    protected $offset = 0;




    /**s
     * @var int
     */
    protected $limit = 0;



    /**
     * @var bool
    */
    protected $distinct = false;



    /**
     * @var array
    */
    protected $from = [];




    /**
     * @var string[]
    */
    protected $orderBy = [];



    /**
     * @var string
    */
    protected $joins = [];



    /**
     * @var array
    */
    protected $groupBy = [];




    /**
     * @var string[]
    */
    protected $having = [];



    /**
     * @var QueryResultInterface
    */
    protected $hydrate;




    /**
     * @inheritDoc
    */
    public function distinct(bool $distinct): static
    {
        $this->distinct = $distinct;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addSelect(string $select): static
    {
         $this->selected[] = $select;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function from(string $table, string $alias = ''): static
    {
         $this->from[] = "$table $alias";

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function orderBy(string $column, string $direction = 'asc'): static
    {
        return $this->addOrderBy(sprintf('%s %s', $column, strtoupper($direction)));
    }





    /**
     * @param string $orderBy
     *
     * @return $this
    */
    public function addOrderBy(string $orderBy): static
    {
         $this->orderBy[] = $orderBy;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function join(string $table, string $condition, string $type = null): static
    {
         $type = $type ? strtoupper($type). " JOIN" : "JOIN";

         $this->joins[] = sprintf('%s %s ON %s', $type, $table, $condition);

         return $this;
    }





    /**
     * @inheritdoc
    */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, "INNER");
    }






    /**
     * @inheritdoc
    */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, "LEFT");
    }






    /**
     * @inheritdoc
    */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, "RIGHT");
    }







    /**
     * @inheritdoc
    */
    public function fullJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, "FULL");
    }








    /**
     * @inheritDoc
    */
    public function groupBy(string $column): static
    {
        $this->groupBy[] = $column;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function having(string $condition): static
    {
        $this->having[] = $condition;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function setMaxResults(int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function setFirstResult(int $offset): static
    {
        $this->offset = $offset;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function hydrate(QueryResultInterface $hydrate): static
    {
        $this->hydrate = $hydrate;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function fetch(): QueryResultInterface
    {
        return $this->connection->statement(
            $this->getSQL(),
            $this->getParameters()
        )->fetch();
    }





    /**
     * @inheritDoc
    */
    public function getQuery(): Query
    {
        return new Query($this->hydrate ?: $this->fetch());
    }






    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
         return $this->buildSelectSQL();
    }






    /**
     * @return string
    */
    public function getTable(): string
    {
        return ($this->from ? join(', ', $this->from) : parent::getTable());
    }




    /**
     * @return string
    */
    private function selectSQL(): string
    {
        $command  =  $this->distinct ? 'SELECT DISTINCT' : 'SELECT';
        $columns  =  join(', ', $this->selected);
        $selected =  join(' ', [$command, $columns]);

        return sprintf('%s FROM %s', $selected, $this->getTable());
    }






    /**
     * @return string
    */
    private function joinSQL(): string
    {
        return ($this->joins ? join(' ', $this->joins) : '');
    }





    /**
     * @return string
    */
    private function groupBySQL(): string
    {
         return ($this->groupBy ? sprintf('GROUP BY %s', join($this->groupBy)) : '');
    }





    /**
     * @return string
    */
    private function havingSQL(): string
    {
        return ($this->having ? sprintf('HAVING %s', join($this->having)) : '');
    }



    /**
     * @return string
    */
    private function orderBySQL(): string
    {
        return ($this->orderBy ? rtrim(sprintf('ORDER BY %s', join(',', $this->orderBy))) : '');
    }




    /**
     * @return string
    */
    private function limitSQL(): string
    {
        if (! $this->limit) {
            return '';
        }

        $limit = "LIMIT $this->limit";

        if ($this->offset) {
            return "$limit OFFSET $this->offset";
        }

        return $limit;
    }





    /**
     * @return string
    */
    private function buildSelectSQL(): string
    {
         return join(' ', array_filter([
             $this->selectSQL(),
             $this->joinSQL(),
             $this->whereSQL(),
             $this->groupBySQL(),
             $this->havingSQL(),
             $this->orderBySQL(),
             $this->limitSQL()
         ])) .';';
    }
}