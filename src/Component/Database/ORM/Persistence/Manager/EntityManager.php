<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Persistence\Event\EventManager;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\Contract\UnitOfWorkInterface;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepository;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryFactory;



/**
 * @inheritdoc
*/
class EntityManager implements EntityManagerInterface
{


    /**
     * Connection
     *
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;




    /**
     * @var Definition
    */
    protected Definition $definition;



    /**
     * @var EntityRepositoryFactory
    */
    protected EntityRepositoryFactory $factory;




    /**
     * @var EventManager
    */
    protected EventManager $eventManager;




    /**
     * @var UnitOfWork
    */
    protected UnitOfWork $unitOfWork;



    /**
     * @var string
    */
    protected string $classname;




    /**
     * @var EntityRepository[]
    */
    protected array $repositories = [];




    /**
     * @param ConnectionInterface $connection
     *
     * @param Definition $definition
    */
    public function __construct(ConnectionInterface $connection, Definition $definition)
    {
         $this->connection   = $connection;
         $this->definition   = $definition;
         $this->factory      = $definition->getRepositoryFactory();
         $this->eventManager = $definition->getEventManager();
         $this->unitOfWork   = new UnitOfWork($this);
    }





    /**
     * @param string $classname
     *
     * @return void
    */
    public function registerClass(string $classname): void
    {
         $this->classname = $classname;
    }





    /**
     * @return string
    */
    public function getClassname(): string
    {
        return $this->classname;
    }






    /**
     * @inheritDoc
    */
    public function isOpen(): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }






    /**
     * Returns connection driver
     *
     * @return mixed
    */
    public function getConnector(): mixed
    {
         return $this->connection->getConnection();
    }








    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return $this->connection->beginTransaction();
    }






    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return $this->connection->commit();
    }







    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return $this->connection->rollback();
    }







    /**
     * @inheritDoc
    */
    public function transaction(Closure $func): bool
    {
         $this->connection->beginTransaction();

         try {
            $func($this);
            $this->flush();
            return $this->connection->commit();
         } catch (\Exception $e) {
            $this->close();
            $this->connection->rollback();
            throw $e;
         }
    }





    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): QueryBuilder
    {
         return new QueryBuilder($this);
    }








    /**
     * @inheritDoc
    */
    public function getUnitOfWork(): UnitOfWorkInterface
    {
         return $this->unitOfWork;
    }





    /**
     * @inheritDoc
    */
    public function getEventManager(): EventManager
    {
        return $this->eventManager;
    }







    /**
     * @inheritDoc
    */
    public function find(string $classname, int $id): mixed
    {
        return $this->getRepository($classname)->find($id);
    }






    /**
     * @inheritDoc
    */
    public function getRepository(string $classname): EntityRepository
    {
        if (isset($this->repositories[$classname])) {
             return $this->repositories[$classname];
        }

        return $this->repositories[$classname] = $this->factory->createRepository($classname);
    }







    /**
     * @inheritDoc
    */
    public function getClassMetadata(string $classname): mixed
    {

    }










    /**
     * @inheritDoc
    */
    public function getMetaDataFactory(): mixed
    {

    }










    /**
     * @inheritDoc
    */
    public function flush(): bool
    {
        return $this->unitOfWork->commit();
    }








    /**
     * @inheritDoc
    */
    public function initialize(object $object): mixed
    {

    }










    /**
     * @inheritDoc
    */
    public function persist(object $object): void
    {
         $this->unitOfWork->persist($object);
    }







    /**
     * @inheritDoc
    */
    public function remove(object $object): void
    {
        $this->unitOfWork->remove($object);
    }









    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->unitOfWork->clear();
    }









    /**
     * @inheritDoc
    */
    public function attach(object $object): void
    {
        $this->unitOfWork->attach($object);
    }










    /**
     * @inheritDoc
    */
    public function detach(object $object): void
    {
         $this->unitOfWork->detach($object);
    }






    /**
     * @inheritDoc
    */
    public function refresh(object $object): mixed
    {

    }







    /**
     * @inheritDoc
    */
    public function contains(object $object): mixed
    {

    }






    /**
     * @inheritDoc
    */
    public function close(): mixed
    {

    }

}