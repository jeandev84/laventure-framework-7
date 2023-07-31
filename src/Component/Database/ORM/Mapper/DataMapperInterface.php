<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapper;


/**
 * @DataMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapper
*/
interface DataMapperInterface
{


      /**
       * @param int $id
       *
       * @return object|null
      */
      public function findById(int $id);




      /**
       * @param array $conditions
       *
       * @return mixed
      */
      public function findAll(array $conditions = []);






      /**
       * @param object $object
       *
       * @return mixed
      */
      public function save(object $object): mixed;






      /**
       * @param object $object
       *
       * @return mixed
      */
      public function insert(object $object): mixed;







      /**
       * @param object $object
       *
       * @return mixed
      */
      public function update(object $object): mixed;








      /**
       * @param object $object
       *
       * @return mixed
      */
      public function delete(object $object): mixed;
}