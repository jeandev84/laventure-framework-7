<?php
namespace Laventure\Component\Database\Connection\Configuration;


/**
 * @ConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Configuration
*/
interface ConfigurationInterface extends \ArrayAccess
{


        /**
         * Returns driver name
         *
         * @return string
        */
        public function getDriverName(): string;






        /**
         * Returns host name
         *
         * @return string
        */
        public function getHostname(): string;






        /**
         * Returns connection user
         *
         * @return string|null
        */
        public function getUsername(): ?string;






        /**
         * Returns connection password
         *
         * @return string|null
        */
        public function getPassword(): ?string;






        /**
         * Returns port
         *
         * @return string
        */
        public function getPort(): string;







        /**
         * Returns name of database
         *
         * @return string
        */
        public function getDatabase(): string;







        /**
         * Returns database encoding characters
         *
         * @return string
        */
        public function getCharset(): string;







        /**
         * Returns collation
         *
         * @return string
        */
        public function getCollation(): string;






        /**
         * Returns table prefix
         *
         * @return string
        */
        public function getPrefix(): string;






        /**
         * Return table with prefix
         *
         * @param string $table
         *
         * @return string
        */
        public function getPrefixedTable(string $table): string;






        /**
         * Returns engine name
         *
         * @return string
        */
        public function getEngine(): string;






        /**
         * @param array $params
         *
         * @return $this
        */
        public function merge(array $params): static;






        /**
         * Returns value of given name
         *
         * @param string $name
         *
         * @param $default
         *
         * @return mixed
        */
        public function get(string $name, $default = null): mixed;






        /**
         * Determine if the given param exist
         *
         * @param string $name
         *
         * @return bool
        */
        public function has(string $name): bool;






        /**
         * Determine if params empty
         *
         * @return bool
        */
        public function isEmpty(): bool;






        /**
         * Returns all configuration params
         *
         * @return array
        */
        public function getParams(): array;






        /**
         * Remove param
         *
         * @param string $name
         *
         * @return bool
        */
        public function remove(string $name): bool;
}