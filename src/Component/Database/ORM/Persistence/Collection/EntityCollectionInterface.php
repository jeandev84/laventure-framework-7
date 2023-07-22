<?php
namespace Laventure\Component\Database\ORM\Persistence\Collection;

/**
 * @inheritdoc
*/
interface EntityCollectionInterface extends \Countable, \ArrayAccess, \IteratorAggregate
{

      /**
       * @param object $object
       *
       * @return mixed
      */
      public function add(object $object);






      /**
       * @param object $object
       *
       * @return mixed
      */
      public function remove(object $object);






      /**
       * @param string $name
       *
       * @return mixed
      */
      public function get(string $name);






      /**
       * @param string $name
       *
       * @return bool
      */
      public function exists(string $name): bool;
}