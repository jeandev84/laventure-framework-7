<?php
namespace Laventure\Component\Database\Connection\Extensions\PDO;



use Exception;
use Laventure\Component\Database\Connection\Query\QueryInterface;
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
    public function open(string $dsn, string $username = null, string $password = null, array $options = [])
    {
         try {

             $this->pdo = new PDO($dsn, $username, $password, array_merge($this->options, $options));

         } catch (Exception $e) {

            throw new PDOException($e->getMessage(), $e->getCode());
         }
    }





    /**
     * @return bool
    */
    public function connected(): bool
    {
        return $this->pdo instanceof PDO;
    }






    /**
     * @return void
    */
    public function disconnect(): void
    {
        $this->pdo = null;
    }





    /**
     * @return bool
    */
    public function disconnected(): bool
    {
        return is_null($this->pdo);
    }




    /**
     * @return QueryInterface
    */
    public function createQuery(): QueryInterface
    {
        return new Statement($this->getPdo());
    }





    /**
     * @param string $sql
     *
     * @return QueryInterface
    */
    public function query(string $sql): QueryInterface
    {
        return $this->createQuery()->query($sql);
    }





    /**
     * @param string $sql
     *
     * @param array $params
     *
     * @return QueryInterface
    */
    public function statement(string $sql, array $params = []): QueryInterface
    {
        return $this->createQuery()->prepare($sql)->bindParams($params);
    }




    /**
     * @return void
    */
    public function beginTransaction(): void
    {
        $this->pdo->beginTransaction();
    }




    /**
     * @return bool
    */
    public function hasActiveTransaction(): bool
    {
        // TODO: Implement hasActiveTransaction() method.
    }




    /**
     * @return void
    */
    public function commit(): void
    {
        $this->pdo->commit();
    }





    /**
     * @return void
    */
    public function rollback(): void
    {
        $this->pdo->rollBack();
    }




    /**
     * @param $name
     *
     * @return int
    */
    public function lastInsertId($name = null): int
    {
        return $this->pdo->lastInsertId($name);
    }




    /**
     * @param string $sql
     *
     * @return bool
    */
    public function executeQuery(string $sql): bool
    {
        return $this->pdo->exec($sql);
    }




    /**
     * @inheritDoc
    */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }




    /**
     * @return array
    */
    public function getDrivers(): array
    {
        return PDO::getAvailableDrivers();
    }




    /**
     * @param string $name
     *
     * @return bool
    */
    public function driverExists(string $name): bool
    {
        return in_array($name, $this->getDrivers());
    }
}