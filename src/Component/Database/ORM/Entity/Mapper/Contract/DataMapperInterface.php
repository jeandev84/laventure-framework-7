<?php
namespace Laventure\Component\Database\ORM\Entity\Mapper\Contract;


/**
 * @DataMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Entity\Mapper\Contract
*/
interface DataMapperInterface
{

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