<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\ORM\Persistence\Event\EventManager;
use Laventure\Component\Database\ORM\Persistence\Repository\EntityRepositoryFactory;


/**
 * @Definition
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Manager
*/
class Definition
{

       /**
        * @param EntityRepositoryFactory $repositoryFactory
        *
        * @param EventManager $eventManager
       */
       public function __construct(
           protected EntityRepositoryFactory $repositoryFactory,
           protected EventManager $eventManager
       )
       {
       }





       /**
        * @return EntityRepositoryFactory
       */
       public function getRepositoryFactory(): EntityRepositoryFactory
       {
            return $this->repositoryFactory;
       }






       /**
        * @return EventManager
       */
       public function getEventManager(): EventManager
       {
            return $this->eventManager;
       }
}