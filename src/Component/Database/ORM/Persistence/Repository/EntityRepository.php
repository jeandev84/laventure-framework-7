<?php
namespace Laventure\Component\Database\ORM\Persistence\Repository;


/**
 * @inheritdoc
*/
class EntityRepository implements EntityRepositoryInterface
{



    protected $em;





    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
        // TODO: Implement find() method.
    }




    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $oderBy = null): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function findAll(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        // TODO: Implement getClassName() method.
    }
}