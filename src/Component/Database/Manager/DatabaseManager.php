<?php
namespace Laventure\Component\Database\Manager;


use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\Exception\DatabaseManagerException;

/**
 * @DatabaseManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Manager
*/
class DatabaseManager
{

        /**
         * @var string
        */
        protected $connection;




        /**
         * @var ConnectionInterface[]
        */
        protected $connections = [];




        /**
         * @var ConfigurationInterface[]
        */
        protected $config = [];





        /**
         * @var ConnectionInterface[]
        */
        protected $connected = [];





        /**
         * @var array
        */
        protected $disconnected = [];





        /**
         * @param string $connection
         *
         * @param array $config
        */
        public function __construct(string $connection, array $config)
        {
             $this->setDefaultConnection($connection);
             $this->setConfigurationFromArray($config);
        }






        /**
         * @param string $connection
         *
         * @return $this
        */
        public function setDefaultConnection(string $connection): static
        {
            $this->connection = $connection;

            return $this;
        }






        /**
          * Returns current connection
          *
          * @param string|null $name
          *
          * @return string
        */
        public function getConnection(string $name = null): string
        {
             return $name ?: $this->connection;
        }






        /**
         * @param ConfigurationInterface $config
         *
         * @return $this
        */
        public function setConfiguration(ConfigurationInterface $config): static
        {
              $this->config[$config->getDriverName()] = $config;

              return $this;
        }






        /**
         * @param array $config
         *
         * @return $this
        */
        public function setConfigurationFromArray(array $config): static
        {
             foreach ($config as $params) {
                 $this->setConfiguration(new Configuration($params));
             }

             return $this;
        }







        /**
         * @param string $name
         *
         * @return ConfigurationInterface
        */
        public function configuration(string $name): ConfigurationInterface
        {
             if (! isset($this->config[$name])) {
                  $this->abortIf("unavailable configuration '$name'.");
             }

             if ($this->config[$name]->isEmpty()) {
                  $this->abortIf("empty params for configuration '$name'");
             }

             return $this->config[$name];
        }




        /**
         * @param ConnectionInterface $connection
         *
         * @return $this
        */
        public function setConnection(ConnectionInterface $connection): static
        {
            $this->connections[$connection->getName()] = $connection;

            return $this;
        }






        /**
         * @param array $connections
         *
         * @return $this
        */
        public function setConnections(array $connections): static
        {
             foreach ($this->connections as $connection) {
                 $this->setConnection($connection);
             }

             return $this;
        }






        /**
         * @param string|null $name
         *
         * @return ConnectionInterface
        */
        public function connection(string $name = null): ConnectionInterface
        {
             $name   = $this->getConnection($name);

             $config = $this->configuration($name);


        }





       /**
         * @param string $message
         *
         * @return void
       */
       private function abortIf(string $message): void
       {
           (function () use ($message) {
              throw new DatabaseManagerException($message);
           })();
      }
}