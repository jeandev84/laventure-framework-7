<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers;

use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\DriverConnection;

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
    public function connect(ConfigurationInterface $config): void
    {

    }





    /**
     * @inheritDoc
    */
    public function getDatabases(): array
    {
        // TODO: Implement getDatabases() method.
    }
}