<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;
use PDO;


/**
 * @Statement
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO
*/
class Statement implements QueryInterface
{


        /**
         * @var PDO
        */
        protected PDO $pdo;



        /**
         * @param PDO $pdo
        */
        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }




        /**
         * @inheritDoc
        */
        public function query(string $sql): static
        {
            return $this;
        }



        /**
        * @inheritDoc
        */
        public function prepare(string $sql): static
        {
            return $this;
        }




        /**
         * @inheritDoc
        */
        public function bindParams(array $params): static
        {
             return $this;
        }



        /**
         * @inheritDoc
        */
        public function bindValues(array $values): static
        {
            return $this;
        }




        /**
         * @inheritDoc
        */
        public function bindColumns(array $columns): static
        {
            return $this;
        }




        /**
         * @inheritDoc
        */
        public function execute(array $parameters = []): mixed
        {
            return $this;
        }





        /**
         * @inheritDoc
        */
        public function fetch(): QueryResultInterface
        {
             return new QueryResult();
        }
}