<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers;

use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\DriverConnection;
use Laventure\Component\Database\Connection\Query\QueryInterface;


/**
 * @MysqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO\Drivers
*/
class MysqlConnection extends DriverConnection
{

    /**
     * @inheritDoc
    */
    public function getName(): string
    {
         return 'mysql';
    }




    /**
     * @inheritDoc
    */
    protected function resolveConfiguration(ConfigurationInterface $config): ConfigurationInterface
    {
        $config['dsn'] = $this->buildPdoDsn($this->getName(), [
            'host'       => $config->getHostname(),
            'port'       => $config->getPort(),
            'charset'    => $config->getCharset()
        ]);

        $config['options'] = [];

        return $config;
    }



    /**
     * @inheritDoc
    */
    public function createDatabase(): bool
    {
        $database = $this->getDatabase();

        $this->exec("CREATE DATABASE IF NOT EXISTS {$database};");

        return in_array($database, $this->getDatabases());
    }




    /**
     * @inheritDoc
    */
    public function dropDatabase(): bool
    {
        $database = $this->getDatabase();

        $this->exec("DROP DATABASE IF EXISTS {$database};");

        return ! in_array($database, $this->getDatabases());
    }






    /**
     * @inheritDoc
    */
    public function getDatabases(): array
    {
        return $this->statement("SHOW DATABASES;")
                    ->fetch()
                    ->columns();
    }





    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return $this->statement("SHOW FULL TABLES FROM {$this->getDatabase()};")
                    ->fetch()
                    ->columns();
    }
}