<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\ORM\Persistence\Manager\Contract\UnitOfWorkInterface;

/**
 * @inheritdoc
*/
class UnitOfWork implements UnitOfWorkInterface
{

        /**
         * @var EntityManager
        */
        protected EntityManager $em;




        /**
         * @param EntityManager $em
        */
        public function __construct(EntityManager $em)
        {
            $this->em = $em;
        }




        /**
         * @inheritDoc
        */
        public function find($id): void
        {
            // TODO: Implement find() method.
        }




        /**
         * @inheritDoc
        */
        public function persist(object $object)
        {
            // TODO: Implement persist() method.
        }




        /**
         * @inheritDoc
        */
        public function remove(object $object): void
        {
            // TODO: Implement remove() method.
        }




        /**
         * @inheritDoc
        */
        public function refresh(object $object): void
        {
            // TODO: Implement refresh() method.
        }





        /**
         * @inheritDoc
        */
        public function attach(object $object): void
        {
            // TODO: Implement attach() method.
        }




        /**
         * @inheritDoc
        */
        public function detach(object $object): void
        {
            // TODO: Implement detach() method.
        }




        /**
         * @inheritDoc
        */
        public function merge(object $object): void
        {
            // TODO: Implement merge() method.
        }




        /**
         * @inheritDoc
        */
        public function commit(): bool
        {
            // TODO: Implement commit() method.
        }




        /**
         * @inheritDoc
        */
        public function rollback(): bool
        {
            // TODO: Implement rollback() method.
        }




        /**
         * @inheritDoc
        */
        public function clear(): void
        {
            // TODO: Implement clear() method.
        }
}