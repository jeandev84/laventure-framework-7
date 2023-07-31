<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager\Contract;


use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepository;



/**
 * @inheritdoc
 *
 * @EntityManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package aventure\Component\Database\ORM\Persistence\Manager\Contract
*/
interface EntityManagerInterface extends ObjectManager
{


    /**
     * Determine if entity manager is open
     *
     * @return bool
    */
    public function isOpen(): bool;







    /**
     * Returns connection real
     *
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;






    /**
     * Returns driver connection
     *
     * @return mixed
    */
    public function getConnection(): mixed;






    /**
     * Begin transaction
     *
     * @return mixed
    */
    public function beginTransaction(): mixed;






    /**
     * Commit changes
     *
     * @return mixed
    */
    public function commit(): mixed;






    /**
     * Rollback changes
     *
     * @return mixed
    */
    public function rollback(): mixed;







    /**
     * @param Closure $func
     *
     * @return mixed
    */
    public function transaction(Closure $func): mixed;









    /**
     * Returns query builder
     *
     * @return mixed
    */
    public function createQueryBuilder(): mixed;






    /**
     * Returns unit of work
     *
     * @return UnitOfWorkInterface
    */
    public function getUnitOfWork(): UnitOfWorkInterface;







    /**
     * Returns event manager
     *
     * @return mixed
    */
    public function getEventManager(): mixed;







    /**
     * Find object by id
     *
     * @param string $classname
     *
     * @param int $id
     *
     * @return object|null
    */
    public function find(string $classname, int $id): mixed;







    /**
     * Returns class repository
     *
     * @param string $classname
     *
     * @return EntityRepository
    */
    public function getRepository(string $classname): EntityRepository;






    /**
     * Returns class meta data
     *
     * @param string $classname
     *
     * @return mixed
    */
    public function getClassMetadata(string $classname): mixed;







    /**
     * Returns metadata factory
     *
     * @return mixed
    */
    public function getMetaDataFactory(): mixed;







    /**
     * Commit changes
     *
     * @return mixed
    */
    public function flush(): mixed;









    /**
     * Close entity manager
     *
     * @return mixed
    */
    public function close(): mixed;
}