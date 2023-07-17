<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;


use Exception;
use Laventure\Component\Database\Connection\Configuration\ConfigurationException;
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
        * @var PdoConfiguration
       */
       protected PdoConfiguration $config;






      /**
       * @param array $credentials
       *
       * @return void
      */
      public function open(array $credentials): void
      {
          $config = new PdoConfiguration($credentials);

          $this->pdo = $this->make($config->toArray());
      }







     /**
      * @param array $config
      *
      * @return PDO
     */
     public function make(array $config): PDO
     {
         try {

             return new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

         } catch (Exception $e) {

             throw new PDOException($e->getMessage(), $e->getCode());
         }
     }







     /**
      * @inheritDoc
     */
     public function getPdo(): PDO
     {
         return $this->pdo;
     }





     /**
      * @return void
     */
     public function close()
     {
         $this->pdo = null;
     }
}