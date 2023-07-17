<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\DriverConnectionException;
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
abstract class DriverConnection implements ConnectionInterface
{


    /**
     * @var PDO|null
    */
    protected ?PDO $connection = null;



    /**
     * @var ConfigurationInterface
    */
    protected ConfigurationInterface $config;





    /**
     * @implements
    */
    public function connect(ConfigurationInterface $config): void
    {
        $this->config     = $config;
        $this->connection = $this->makePdo($this->config);

        if ($this->hasDatabase()) {
            $this->config['dsn'] = $this->refreshPdoDsn($this->config);
            $this->connection = $this->makePdo($this->config);
        }
    }




    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
         return $this->connection instanceof PDO;
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
    public function disconnect(): void
    {
        $this->connection = null;
    }





    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
        return is_null($this->connection);
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
         $this->connection->beginTransaction();
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
         $this->connection->commit();
    }




    /**
     * @inheritDoc
    */
    public function rollback(): void
    {
        $this->connection->rollBack();
    }



    /**
     * @inheritDoc
    */
    public function lastInsertId($name = null): int
    {
       return $this->connection->lastInsertId($name);
    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        return $this->connection->exec($sql);
    }





    /**
     * @inheritDoc
    */
    public function getConnection(): PDO
    {
         return $this->connection;
    }





    /**
     * @inheritDoc
    */
    public function config(): ConfigurationInterface
    {
         return $this->config;
    }






    /**
     * @inheritDoc
    */
    public function hasDatabase(): bool
    {
        return in_array($this->config->getDatabase(), $this->getDatabases());
    }





    /**
     * @return array
    */
    public function getDatabases(): array
    {
        return [];
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return PdoConnection
    */
    private function makePdoConnection(ConfigurationInterface $config): PdoConnection
    {
        if (! $dsn = $config->get('dsn')) {
            $dsn = $this->buildPdoDsn($config);
        }

        return new PdoConnection(
            $dsn,
            $config->getUsername(),
            $config->getPassword(),
            $config->get('options', [])
        );
    }



    /**
     * @param ConfigurationInterface $config
     *
     * @return PDO
    */
    private function makePdo(ConfigurationInterface $config): PDO
    {
        if (! $dsn = $config->get('dsn')) {
            $dsn = $this->buildPdoDsn($config);
        }

        $connection = new PdoConnection(
            $dsn,
            $config->getUsername(),
            $config->getPassword(),
            $config->get('options', [])
        );


        return $connection->getPdo();
    }






    /**
     * @param ConfigurationInterface $config
     *
     * @return string
    */
    private function buildPdoDsn(ConfigurationInterface $config): string
    {
        $driver = $config->getDriverName();

        if (! PdoConnection::driverExists($driver)) {
            $this->createDriverException("Unavailable driver '$driver'");
        }

        if ($driver === 'sqlite') {
            return sprintf('%s:database=%s', $driver, $config->getDatabase());
        }

        return sprintf('%s:%s', $driver, http_build_query([
            'host'       => $config->getHostname(),
            'port'       => $config->getPort(),
            'charset'    => $config->getCharset()
        ],'', ';'));
    }





    /**
     * @param ConfigurationInterface $config
     *
     * @return string
    */
    private function refreshPdoDsn(ConfigurationInterface $config): string
    {
         return sprintf('%s;database=%s;', $this->buildPdoDsn($config), $config->getDatabase());
    }







    /**
     * @param string $message
     *
     * @return void
    */
    private function createDriverException(string $message): void
    {
        (function () use ($message) {
            throw new DriverConnectionException($message);
        })();
    }
}