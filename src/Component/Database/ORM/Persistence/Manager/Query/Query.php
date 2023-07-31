<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager\Query;

use Laventure\Component\Database\Connection\Query\QueryResultInterface;
use Laventure\Component\Database\ORM\Persistence\Manager\EntityManager;

class Query
{

    /**
     * @param EntityManager $em
     *
     * @param QueryResultInterface $hydrate
   */
   public function __construct(protected EntityManager $em, protected QueryResultInterface $hydrate)
   {

   }




    /**
     * Returns all records
     *
     * @return array|mixed
     */
    public function getResult(): mixed
    {
        return $this->hydrate->all();
    }




    /**
     * Return on record
     *
     * @return mixed
    */
    public function getOneOrNullResult(): mixed
    {
        return $this->hydrate->one();
    }





    /**
     * @return array
    */
    public function getArrayResult(): array
    {
        return $this->hydrate->assoc();
    }





    /**
     * @return array
    */
    public function getArrayColumns(): array
    {
        return $this->hydrate->columns();
    }
}