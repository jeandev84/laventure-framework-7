<?php
namespace Laventure\Component\Database;


use Laventure\Component\Database\ORM\Entity\Manager\Persistence\EntityManagerInterface;


/**
 * @Manager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database
*/
class Manager extends DatabaseManager
{


      /**
       * @var static
      */
      protected static $instance;




      /**
       * @var EntityManagerInterface
      */
      protected EntityManagerInterface $em;





      /**
       * Add connections
       *
       * @param array $config
       *
       * @return void
     */
     public function addConnections(array $config): void
     {
          $this->connect($config['connection'] ?? '', $config['connections'] ?? []);
     }






    /**
     * Set entity manager
     *
     * @param EntityManagerInterface $em
     *
     * @return $this
    */
    public function setEntityManager(EntityManagerInterface $em): static
    {
        $this->em = $em;

        return $this;
    }






    /**
     * Returns entity manager
     *
     * @return EntityManagerInterface
    */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }


}