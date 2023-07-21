<?php
namespace Laventure\Component\Database\ORM\Entity\Manager\Persistence;


/**
 * @ObjectManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Entity\Manager\Persistence
*/
interface ObjectManager
{

     /**
      * Initialize object
      *
      * @param object $object
      *
      * @return mixed
     */
     public function initialize(object $object): mixed;





     /**
      * Persist object
      *
      * @param object $object
      *
      * @return mixed
     */
     public function persist(object $object): mixed;







     /**
      * Remove object
      *
      * @param object $object
      *
      * @return mixed
     */
     public function remove(object $object): mixed;








     /**
      * @return mixed
     */
     public function clear(): mixed;




     /**
      * Add object in storage
      *
      * @param object $object
      *
      * @return mixed
     */
     public function attach(object $object): mixed;





     /**
      * Unset object from the storage
      *
      * @param object $object
      *
      * @return mixed
     */
     public function detach(object $object): mixed;









      /**
       * Refresh object
       *
       * @param object $object
       *
       * @return mixed
     */
     public function refresh(object $object): mixed;






     /**
      * Determine if object in storage
      *
      * @param object $object
      *
      * @return mixed
     */
     public function contains(object $object): mixed;
}