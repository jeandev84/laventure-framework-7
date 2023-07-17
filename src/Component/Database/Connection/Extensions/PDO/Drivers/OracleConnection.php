<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO\Drivers;

use Laventure\Component\Database\Connection\Extensions\PDO\DriverConnection;

/**
 * @OracleConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO\Drivers
*/
class OracleConnection extends DriverConnection
{

    /**
     * @inheritDoc
    */
    public function getName(): string
    {
         return 'oci';
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
    public function dropDatabase(): bool
    {
        // TODO: Implement dropDatabase() method.
    }
}