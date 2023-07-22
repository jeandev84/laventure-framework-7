<?php
namespace Laventure\Component\Database\ORM\Collection;

use Laventure\Component\Database\ORM\Collection\Contract\ObjectStorage;

/**
 * @inheritdoc
*/
abstract class Collection extends ObjectStorage
{
    /**
     * @param object $object
     *
     * @return void
     */
    public function add(object $object): void
    {
        $this->attach($object);
    }




    /**
     * @param object $object
     *
     * @return void
    */
    public function remove(object $object): void
    {
        $this->detach($object);
    }
}