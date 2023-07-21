<?php
namespace Laventure\Component\Database\ORM\Entity\Manager\Persistence;



/**
 * @EntityManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Entity\Manager\Persistence
*/
interface EntityManagerInterface extends ObjectManager
{
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
     * @return mixed
    */
    public function getRepository(string $classname): mixed;






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

}