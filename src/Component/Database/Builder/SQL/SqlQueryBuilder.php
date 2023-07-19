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
class SqlQueryBuilder implements SqlQueryBuilderInterface
{


    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;





    /**
     * @var string
    */
    protected string $table;




    /**
     * @param ConnectionInterface $connection
     *
     * @param string $table
    */
    public function __construct(ConnectionInterface $connection, string $table)
    {
         $this->connection = $connection;
         $this->table      = $table;
    }



    /**
     * @inheritDoc
    */
    public function select(string $selects = null, array $wheres = []): Select
    {
         $command = new Select($this->connection, $this->table);
         $command->criteria($wheres);
         return $command;
    }





    /**
     * @inheritDoc
    */
    public function insert(array $attributes): Insert
    {
         $command = new Insert($this->connection, $this->table);
         $command->attributes($attributes);
         return $command;
    }






    /**
     * @inheritDoc
    */
    public function update(array $attributes, array $wheres = []): Update
    {
         $command = new Update($this->connection, $this->table);
         $command->criteria($wheres);
         return $command;
    }





    /**
     * @inheritDoc
    */
    public function delete(array $wheres = []): Delete
    {
        $command = new Delete($this->connection, $this->table);
        $command->criteria($wheres);
        return $command;
    }




    /**
     * @inheritDoc
    */
    public function getTable(): string
    {
        return $this->table;
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }
}