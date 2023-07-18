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
         $this->config = $this->resolve($config);

         $this->connectionBefore($this->config);

         if (in_array($this->config['database'], $this->getDatabases())) {
              $this->connectionAfter($this->config);
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





    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    private function connectionBefore(ConfigurationInterface $config): void
    {
        $this->open($config['dsn'], $config->getUsername(), $config->getPassword(), $config->get('options', []));
    }





    /**
     * @param ConfigurationInterface $config
     *
     * @return void
     */
    private function connectionAfter(ConfigurationInterface $config): void
    {
        $config['dsn'] .= ';database='. $config->getDatabase();

        $this->open($config['dsn'], $config->getUsername(), $config->getPassword(), $config->get('options', []));
    }


    /**
     * @param string $driver
     *
     * @param array $params
     *
     * @return string
    */
    protected function buildPdoDsn(string $driver, array $params): string
    {
         return sprintf('%s:%s',  $driver, http_build_query($params,'', ';'));
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return ConfigurationInterface
    */
    abstract protected function resolve(ConfigurationInterface $config): ConfigurationInterface;
}