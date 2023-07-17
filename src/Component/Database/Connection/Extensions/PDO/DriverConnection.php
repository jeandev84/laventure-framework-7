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




    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    private function connectionBefore(ConfigurationInterface $config): void
    {
        $this->open(
            $this->makePdoDsn($config),
            $config->getUsername(),
            $config->getPassword(),
            $config->get('options', [])
        );
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return void
     */
    private function connectionAfter(ConfigurationInterface $config): void
    {
        $this->open(
            $this->refreshPdoDsn($config),
            $config->getUsername(),
            $config->getPassword(),
            $config->get('options', [])
        );
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return string
     */
    private function makePdoDsn(ConfigurationInterface $config): string
    {
        if ($config->has('dsn')) {
            return $config->get('dsn');
        }

        return $this->buildPdoDsn($config);
    }





    /**
     * @param ConfigurationInterface $config
     *
     * @return string
     */
    private function buildPdoDsn(ConfigurationInterface $config): string
    {
        $driver = $config->getDriverName();

        if (! $this->driverExists($driver)) {
            $this->createDriverException("Unavailable driver '$driver'");
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