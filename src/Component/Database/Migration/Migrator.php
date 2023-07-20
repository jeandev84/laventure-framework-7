<?php
namespace Laventure\Component\Database\Migration;


use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Migration\Contract\MigratorInterface;


/**
 * @Migrator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Migration
*/
class Migrator implements MigratorInterface
{

    /**
     * @var string
    */
    protected string $table = 'migrations';



    /**
     * @var Migration[]
    */
    protected array $migrations = [];



    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;



    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
         $this->connection = $connection;
    }





    /**
     * Set migration version table
     *
     * @param string $table
     *
     * @return $this
    */
    public function table(string $table): static
    {
        $this->table = $table;

        return $this;
    }





    /**
     * @param Migration $migration
     *
     * @return $this
    */
    public function addMigration(Migration $migration): static
    {
         $this->migrations[$migration->getName()] = $migration;

         return $this;
    }




    /**
     * @param Migration[] $migrations
     *
     * @return $this
    */
    public function addMigrations(array $migrations): static
    {
        foreach ($migrations as $migration) {
             $this->addMigration($migration);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function install(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function migrate(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function reset(): bool
    {

    }






    /**
     * @inheritDoc
    */
    public function refresh(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getMigrations(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function getMigrationsToApply(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function getAppliedMigrations(): array
    {
        // TODO: Implement getAppliedMigrations() method.
    }
}