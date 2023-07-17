<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers;


use Laventure\Component\Database\Connection\Extensions\PDO\DriverConnection;

/**
 * @PgsqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO\Drivers
*/
class PgsqlConnection extends DriverConnection
{

    /**
     * @inheritDoc
    */
    public function getName(): string
    {
         return 'pgsql';
    }




    /**
     * @inheritDoc
    */
    public function createDatabase(): bool
    {
        // TODO: Implement createDatabase() method.
    }



    /**
     * @inheritDoc
    */
    public function getDatabases(): array
    {
        // TODO: Implement getDatabases() method.
    }
}