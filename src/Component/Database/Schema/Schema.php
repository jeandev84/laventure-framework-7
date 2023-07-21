<?php
namespace Laventure\Component\Database\Schema;

use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\BluePrintFactory;



/**
 * @Schema
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema
*/
class Schema implements SchemaInterface
{


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(protected ConnectionInterface $connection)
    {
    }





    /**
     * @inheritDoc
    */
    public function create(string $table, Closure $closure): bool
    {
          $blueprint = BluePrintFactory::make($this->connection, $table);

          $closure($blueprint);

          return $blueprint->createTable();
    }





    /**
     * @inheritDoc
    */
    public function update(string $table, Closure $closure): bool
    {
        $blueprint = BluePrintFactory::make($this->connection, $table);

        $closure($blueprint);

        return $blueprint->updateTable();
    }





    /**
     * @inheritDoc
    */
    public function drop(string $table): bool
    {
        return BluePrintFactory::make($this->connection, $table)->dropTable();
    }






    /**
     * @inheritDoc
    */
    public function dropIfExists(string $table): bool
    {
        return BluePrintFactory::make($this->connection, $table)->dropTableIfExists();
    }






    /**
     * @inheritDoc
    */
    public function truncate(string $table): mixed
    {
        return BluePrintFactory::make($this->connection, $table)->truncateTable();
    }





    /**
     * @inheritDoc
    */
    public function truncateCascade(string $table): bool
    {
        return BluePrintFactory::make($this->connection, $table)->truncateTableCascade();
    }






    /**
     * @inheritdoc
    */
    public function exists(string $table): bool
    {
        return in_array($table, $this->getTables());
    }








    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return $this->connection->getTables();
    }




    /**
     * @inheritDoc
    */
    public function describe(string $table): mixed
    {
         return BluePrintFactory::make($this->connection, $table)->describeTable();
    }





    /**
     * @inheritDoc
    */
    public function columns(string $table): array
    {
         return BluePrintFactory::make($this->connection, $table)->getTableColumns();
    }
}