<?php
namespace Laventure\Component\Database\ORM\Entity\UnitOfWork;


/**
 * @UnitOfWorkInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\UnitOfWork
*/
interface UnitOfWorkInterface
{

     const STATE_NEW     = "NEW";
     const STATE_CLEAN   = "CLEAN";
     const STATE_DIRTY   = "DIRTY";
     const STATE_REMOVED = "REMOVED";



     /**
      * @param $id
      *
      * @return mixed
     */
     public function find($id): mixed;





     /**
      * @param object $object
      *
      * @return mixed
     */
     public function new(object $object);





     /**
      * @param object $object
      *
      * @return mixed
     */
     public function clean(object $object): mixed;







     /**
      * @param object $object
      *
      * @return mixed
     */
     public function persist(object $object): mixed;





     /**
      * @param object $object
      *
      * @return mixed
     */
     public function remove(object $object): mixed;







     /**
      * Commit changes
      *
      * @return mixed
     */
     public function commit(): mixed;







     /**
      * @return mixed
     */
     public function rollback(): mixed;






     /**
      * @return mixed
     */
     public function clear(): mixed;
}