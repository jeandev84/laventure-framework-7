<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager\Contract;


/**
 * @UnitOfWorkInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Persistence\Manager\Contract
*/
interface UnitOfWorkInterface
{

     const STATE_NEW     = "NEW";
     const STATE_CLEAN   = "CLEAN";
     const STATE_DIRTY   = "DIRTY";
     const STATE_REMOVED = "REMOVED";




     /**
      * Find object by id
      *
      * @param $id
      *
      * @return void
     */
     public function find($id): void;





     /**
      * Register state NEW or UPDATE
      *
      * @param object $object
      *
      * @return void
     */
     public function persist(object $object);









     /**
      * Register state REMOVED
      *
      * @param object $object
      *
      * @return void
     */
     public function remove(object $object): void;







     /**
      * @param object $object
      *
      * @return void
     */
     public function refresh(object $object): void;






     /**
      * @param object $object
      *
      * @return void
     */
     public function attach(object $object): void;







     /**
      * @param object $object
      *
      * @return void
     */
     public function detach(object $object): void;






     /**
      * @param object $object
      *
      * @return void
     */
     public function merge(object $object): void;






     /**
      * Commit changes
      *
      * @return bool
     */
     public function commit(): bool;







     /**
      * @return bool
     */
     public function rollback(): bool;






     /**
      * @return void
     */
     public function clear(): void;
}