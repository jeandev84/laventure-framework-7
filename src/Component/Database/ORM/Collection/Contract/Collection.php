<?php
namespace Laventure\Component\Database\ORM\Collection\Contract;


/**
 * @inheritdoc
*/
abstract class Collection extends \SplObjectStorage
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




    /**
     * @return int
    */
    public function clear(): int
    {
        return $this->removeAll($this);
    }




    /**
     * @inheritDoc
     */
    public function __serialize(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function __unserialize(array $data): void
    {

    }
}