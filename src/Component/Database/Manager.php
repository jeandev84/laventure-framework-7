<?php
namespace Laventure\Component\Database;


/**
 * @Manager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database
*/
class Manager extends DatabaseManager
{

      /**
       * Add connections
       *
       * @param array $config
       *
       * @return void
     */
     public function addConnections(array $config): void
     {
          $this->connect($config['connection'], $config['connections']);
     }
}