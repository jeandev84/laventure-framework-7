<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Connection\Query\QueryException;
use Laventure\Component\Database\Connection\Query\QueryInterface;
use Laventure\Component\Database\Connection\Query\QueryLogger;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;
use PDO;
use PDOStatement;


/**
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extensions\PDO
*/
class Query implements QueryInterface
{

    /**
     * @var PDO
    */
    protected PDO $pdo;




    /**
     * @var PDOStatement
    */
    protected PDOStatement $statement;



    /**
     * @var QueryLogger
    */
    protected QueryLogger $logger;



    /**
     * @var array
    */
    protected array $bindings = [];



    /**
     * @param PDO $pdo
    */
    public function __construct(PDO $pdo)
    {
        $this->pdo       = $pdo;
        $this->statement = new PDOStatement();
        $this->logger    = new QueryLogger();
    }




    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
        $this->statement = $this->pdo->prepare($sql);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function query(string $sql): static
    {
        $this->statement = $this->pdo->query($sql);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function bindParams(array $params): static
    {
        foreach ($params as $key => $value) {
            $this->statement->bindParam($key, $value);
        }

        $this->bindings['params'][] = $params;

        return $this;
    }





    /**
     * @inheritdoc
    */
    public function bindColumns(array $columns): static
    {
        foreach ($columns as $key => $value) {
            $this->statement->bindColumn($key, $value);
        }

        $this->bindings['columns'][] = $columns;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function bindValues(array $values): static
    {
        foreach ($values as $key => $value) {
            $this->statement->bindValue($key, $value);
        }

        $this->bindings['values'][] = $values;

        return $this;
    }





    /**
     * @inheritDoc
     *
     * @throws QueryException
    */
    public function execute(array $parameters = []): mixed
    {
        try {

            if ($this->statement->execute($parameters)) {

                $this->logger->log([
                    'sql'            => $this->statement->queryString,
                    'bindings'       => $this->bindings,
                    'parameters'     => $parameters
                ]);
            }

        } catch (\PDOException $e) {

            throw new QueryException($e->getMessage(), $e->getCode());
        }
    }





    /**
     * @inheritDoc
     */
    public function fetch(): QueryResultInterface
    {
        return new QueryResult($this);
    }



    /**
     * @inheritDoc
     */
    public function getBindParams(): array
    {
        return $this->bindings['params'] ?? [];
    }



    /**
     * @inheritDoc
     */
    public function getBindValues(): array
    {
        return $this->bindings['values'] ?? [];
    }




    /**
     * @inheritDoc
    */
    public function getBindColumns(): array
    {
        return $this->bindings['columns'] ?? [];
    }




    /**
     * @inheritDoc
    */
    public function getQueryLog(): array
    {
        // TODO: Implement getQueryLog() method.
    }
}