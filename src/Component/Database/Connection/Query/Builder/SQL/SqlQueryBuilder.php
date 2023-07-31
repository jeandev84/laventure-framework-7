<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL;


use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Delete;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Insert;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Update;
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
    public function select(string $selects = null): Select
    {
         $command = new Select($this->connection, $this->table);
         $command->addSelect($selects ?: "*");
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
    public function update(array $attributes): Update
    {
         return new Update($this->connection, $this->table);
    }





    /**
     * @inheritDoc
    */
    public function delete(): Delete
    {
        return new Delete($this->connection, $this->table);
    }
}