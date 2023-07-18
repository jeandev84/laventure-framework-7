<?php
namespace Laventure\Component\Database\Connection;


use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;



/**
 * @ConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection
*/
interface ConnectionInterface
{

    /**
     * Returns connection name
     *
     * @return string
    */
    public function getName(): string;





    /**
     * Connect to the database
     *
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function connect(ConfigurationInterface $config): void;







    /**
     * Determine if the connection established
     *
     * @return bool
     */
    public function connected(): bool;







    /**
     * Reconnection to the database
     *
     * @return void
    */
    public function reconnect(): void;







    /**
     * Disconnect to the database
     *
     * @return void
    */
    public function disconnect(): void;






    /**
     * Determine if connection is not established
     *
     * @return bool
    */
    public function disconnected(): bool;






    /**
     * Create a new query
     *
     * @return QueryInterface
    */
    public function createQuery(): QueryInterface;









    /**
     * Prepare query
     *
     * @param string $sql
     *
     * @param array $params
     *
     * @return QueryInterface
    */
    public function statement(string $sql, array $params = []): QueryInterface;








    /**
     * Begin a transaction query
     *
     * @return void
    */
    public function beginTransaction(): void;






    /**
     * @return bool
    */
    public function hasActiveTransaction(): bool;






    /**
     * Commit transaction
     *
     * @return void
    */
    public function commit(): void;





    /**
     * Rollback transaction
     *
     * @return void
    */
    public function rollback(): void;






    /**
     * Get last insert id
     *
     * @param $name
     *
     * @return int
    */
    public function lastInsertId($name = null): int;






    /**
     * Execute query
     *
     * @param string $sql
     *
     * @return bool
    */
    public function executeQuery(string $sql): bool;







    /**
     * Returns connection driver
     *
     * @return mixed
    */
    public function getConnection(): mixed;








    /**
     * Returns configuration
     *
     * @return ConfigurationInterface
    */
    public function config(): ConfigurationInterface;






    /**
     * Returns databases
     *
     * @return array
    */
    public function getDatabases(): array;






    /**
     * Create database
     *
     * @return mixed
    */
    public function createDatabase(): mixed;






    /**
     * Drop database
     *
     * @return mixed
    */
    public function dropDatabase(): mixed;








    /**
     * Determine if database exists
     *
     * @return bool
    */
    public function hasDatabase(): bool;




    /**
     * @return array
    */
    public function getExecutedQueries(): array;
}