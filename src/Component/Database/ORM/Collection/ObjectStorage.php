<?php
namespace Laventure\Component\Database\ORM\Collection\Contract;


/**
 * @inheritdoc
*/
class ObjectStorage extends \SplObjectStorage
{


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