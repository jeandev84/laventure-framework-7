<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager\Contract;


/**
 * @ObjectManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Manager\Contract
*/
interface ObjectManager
{



        /**
         * Tells manager to initialize an object
         *
         * @param object $object
         *
         * @return mixed
        */
        public function initialize(object $object): mixed;





        /**
        * Tells the manager to make an instance managed and persistent
        *
        * @param object $object
        *
        * @return void
        */
        public function persist(object $object): void;







        /**
         * Tells the manager to removes an instance
         *
         * @param object $object
         *
         * @return void
        */
        public function remove(object $object): void;








        /**
         * Tells manager remove all objects in storage
         *
         * @return void
        */
        public function clear(): void;








        /**
         *  Tells the manager must save and object in storage
         *
         * @param object $object
         *
         * @return void
        */
        public function attach(object $object): void;





        /**
         * Tells the manager must detach an object from the storage
         *
         * @param object $object
         *
         * @return void
        */
        public function detach(object $object): void;








        /**
         * Tells manager to refresh an instance
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