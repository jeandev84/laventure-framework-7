<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager\Query\SQL\Commands\DQL;


use Laventure\Component\Database\ORM\Persistence\Manager\EntityManager;
use Laventure\Component\Database\ORM\Persistence\Manager\Query\Query;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DQL\Select as SelectQuery;


/**
 * @inheritdoc
*/
class Select extends SelectQuery
{


    /**
     * @var EntityManager
    */
    protected EntityManager $em;



    /**
     * @param EntityManager $em
    */
    public function __construct(EntityManager $em)
    {
        $table = 'demo';
        parent::__construct($em->getConnection(), $table);
        $this->em = $em;
    }




    /**
     * @return Query
    */
    public function getQuery(): Query
    {
        return new Query($this->em, $this->fetch());
    }
}