<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;


use PDO;


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
      * @param PdoConfiguration $config
      *
      * @return void
     */
     public function open(PdoConfiguration $config): void
     {
         try {

             $this->pdo = new PDO($config->getDsn(), $config->getUsername(), $config->getPassword(), $config->getOptions());

             $this->config = $config;


         } catch (\PDOException $e) {

             throw new \PDOException($e->getMessage(), $e->getCode());
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






     /**
      * @return PdoConfiguration
     */
     protected function getConfiguration(): PdoConfiguration
     {
         return $this->config;
     }
}