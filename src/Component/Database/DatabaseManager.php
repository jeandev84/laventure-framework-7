<?php
namespace Laventure\Component\Database;


use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\ConnectionStack;

/**
 * @DatabaseManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database
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
         * @param string $connection
         *
         * @param array $config
         *
         * @return void
        */
        public function connect(string $connection, array $config): void
        {
             $this->setDefaultConnection($connection);
             $this->setConfigurations($config);
             $this->setConnections(ConnectionStack::defaults());
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
        public function getCurrentConnection(string $name = null): string
        {
             return $name ?: $this->connection;
        }


        /**
         * @param string $name
         *
         * @param ConfigurationInterface $config
         *
         * @return $this
        */
        public function setConfiguration(string $name, ConfigurationInterface $config): static
        {
              $this->config[$name] = $config;

              return $this;
        }






        /**
         * Set configuration from arrays
         *
         * @param array $config
         *
         * @return $this
        */
        public function setConfigurations(array $config): static
        {
             foreach ($config as $name => $params) {
                 $this->setConfiguration($name, new Configuration($params));
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
         * Determine if exists connection by given name
         *
         * @param string $name
         *
         * @return bool
        */
        public function hasConnection(string $name): bool
        {
            return isset($this->connections[$name]);
        }







        /**
         * @param array $connections
         *
         * @return $this
        */
        public function setConnections(array $connections): static
        {
             foreach ($connections as $connection) {
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
             $name   = $this->getCurrentConnection($name);
             $config = $this->configuration($name);

             if (! $this->hasConnection($name)) {
                 $this->abortIf("unavailable connection named '$name'");
             }

             return $this->make($name, $config);
        }






        /**
         * @param string $name
         *
         * @return bool
        */
        public function connected(string $name): bool
        {
             return isset($this->connected[$name]);
        }






        /**
         * @param string $name
         *
         * @param ConfigurationInterface $config
         *
         * @return ConnectionInterface
       */
       private function make(string $name, ConfigurationInterface $config): ConnectionInterface
       {
            $this->connections[$name]->connect($config);

            if (! $this->connections[$name]->connected()) {
               $this->abortIf("no connection detected for '$name'.");
            }

            return $this->connected[$name] = $this->connections[$name];
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