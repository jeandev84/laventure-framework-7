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
abstract class DriverConnection extends PdoConnection implements ConnectionInterface
{

    /**
     * @var ConfigurationInterface
    */
    protected ConfigurationInterface $config;



    /**
     * @inheritDoc
    */
    public function connect(ConfigurationInterface $config): void
    {
         $this->setConnection($config);
    }






    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function setConnection(ConfigurationInterface $config): void
    {
         $this->config = $config;
         $this->connectionBefore($config);

         if (in_array($config['database'], $this->getDatabases())) {
              $this->connectionAfter($config);
         }
    }






    /**
     * @inheritDoc
    */
    public function getConnection(): PDO
    {
        return $this->pdo;
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
    public function getDatabases(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function hasDatabase(): bool
    {
       return in_array($this->config->getDatabase(), $this->getDatabases());
    }





    /**
     * @inheritDoc
    */
    public function reconnect(): void
    {
         $this->connect($this->config);
    }
}