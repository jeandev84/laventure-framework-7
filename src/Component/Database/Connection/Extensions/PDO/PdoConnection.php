<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;


use Exception;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use PDO;
use PDOException;


/**
 * @PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO
*/
class PdoConnection implements PdoConnectionInterface
{


       /**
        * @var PDO
       */
       protected $pdo;




       /**
        * @var array
       */
       protected array $options = [
          PDO::ATTR_PERSISTENT          => true,
          PDO::ATTR_EMULATE_PREPARES    => 0,
          PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ,
          PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION,
        ];




        /**
         * @param string $dsn
         *
         * @param string|null $username
         *
         * @param string|null $password
         *
         * @param array $options
        */
        public function __construct(string $dsn, string $username = null, string $password = null, array $options = [])
        {
             try {

                 $this->pdo = new PDO($dsn, $username, $password, array_merge($this->options, $options));

             } catch (Exception $e) {

                 throw new PDOException($e->getMessage(), $e->getCode());
             }
        }



        public static function make(ConfigurationInterface $config)
        {
             $connection = new static($config->get('dsn'));
        }






        /**
         * @inheritDoc
        */
        public function getPdo(): PDO
        {
             return $this->pdo;
        }




        /**
         * @param string $name
         *
         * @return bool
        */
        public static function driverExists(string $name): bool
        {
             return in_array($name, PDO::getAvailableDrivers());
        }





       /**
        * @param ConfigurationInterface $config
        *
        * @return string
       */
       private function buildPdoDsn(ConfigurationInterface $config): string
       {
            $driver = $config->getDriverName();

            if (! self::driverExists($driver)) {

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
}