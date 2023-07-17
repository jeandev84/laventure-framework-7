<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers;

use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\DriverConnection;

/**
 * @SqliteConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO\Drivers
*/
class SqliteConnection extends DriverConnection
{

    /**
     * @inheritDoc
    */
    public function getName(): string
    {
         return 'sqlite';
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return void
    */
    public function connect(ConfigurationInterface $config): void
    {
        $config['dsn'] = sprintf('%s:database=%s', $config['driver'], $config['database']);

        parent::connect($config);
    }



    /**
     * @inheritDoc
    */
    public function createDatabase(): bool
    {
         return true;
    }




    /**
     * @inheritDoc
    */
    public function dropDatabase(): bool
    {
        // TODO: Implement dropDatabase() method.
    }
}