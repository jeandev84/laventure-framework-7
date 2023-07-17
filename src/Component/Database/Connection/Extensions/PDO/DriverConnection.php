<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use PDO;


/**
 * @DriverConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO
*/
abstract class DriverConnection extends PdoConnection implements ConnectionInterface
{


    /**
     * @implements
    */
    public function connect(ConfigurationInterface $config): void
    {
         $this->open($config->getParams());
    }







    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
         return $this->pdo instanceof PDO;
    }





    /**
     * @inheritDoc
    */
    public function reconnect(): void
    {
        $this->connect($this->config);
    }








    /**
     * @inheritDoc
    */
    public function reconnected(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function disconnect(): void
    {
         $this->close();
    }





    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
        return is_null($this->pdo);
    }






    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function query(string $sql): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function statement(string $sql, array $params = []): QueryInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function beginTransaction(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function hasActiveTransaction(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function commit(): void
    {

    }




    /**
     * @inheritDoc
    */
    public function rollback(): void
    {

    }



    /**
     * @inheritDoc
    */
    public function lastInsertId($name = null): int
    {

    }




    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getConnection(): mixed
    {
         return $this->getPdo();
    }





    /**
     * @inheritDoc
    */
    public function config(): ConfigurationInterface
    {
        return $this->getConfiguration();
    }






    /**
     * @inheritDoc
    */
    public function hasDatabase(): bool
    {
        return in_array($this->config->getDatabase(), $this->getDatabases());
    }
}