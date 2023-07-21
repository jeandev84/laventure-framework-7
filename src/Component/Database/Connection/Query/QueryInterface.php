<?php
namespace Laventure\Component\Database\Connection\Query;


/**
 * @QueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query
*/
interface QueryInterface
{

        /**
         * Simple query
         *
         * @param string $sql
         *
         * @return $this
        */
        public function query(string $sql): static;





        /**
         * Prepare sql statement
         *
         * @param string $sql
         *
         * @return $this
        */
        public function prepare(string $sql): static;





        /**
         * Bind query params
         *
         * @param array $params
         *
         * @return $this
        */
        public function bindParams(array $params): static;







        /**
         * Bind query values
         *
         * @param array $values
         *
         * @return $this
        */
        public function bindValues(array $values): static;





        /**
         * Bind query columns
         *
         * @param array $columns
         * @return $this
        */
        public function bindColumns(array $columns): static;





        /**
         * Execute query
         *
         * @param array $parameters
         *
         * @return mixed
        */
        public function execute(array $parameters = []): mixed;






        /**
         * Execute query
         *
         * @param string $sql
         *
         * @return mixed
        */
        public function exec(string $sql): mixed;





        /**
         * Map class
         *
         * @param string $class
         *
         * @return mixed
        */
        public function map(string $class): static;






        /**
         * Fetch Result
         *
         * @return QueryResultInterface
        */
        public function fetch(): QueryResultInterface;






        /**
         * Returns executed query params
         *
         * @return array
        */
        public function getQueryLog(): array;
}