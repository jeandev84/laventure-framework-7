<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\QueryHydrateInterface;
use Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract\SelectBuilderInterface;
use Laventure\Component\Database\Connection\Query\QueryResultInterface;


/**
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DQL
*/
class Query implements QueryHydrateInterface
{


      /**
       * @var QueryResultInterface
      */
      protected QueryResultInterface $hydrate;




      /**
       * @param Select $builder
       *
       * @param string|null $classname
      */
      public function __construct(Select $builder, string $classname = null)
      {
            $this->hydrate = $builder->fetch();

            if ($classname) {
                $this->hydrate->map($classname);
            }
      }





      /**
       * Returns all records
       *
       * @return array|mixed
      */
      public function getResult(): mixed
      {
          return $this->hydrate->all();
      }







      /**
       * @inheritdoc
      */
      public function getOneOrNullResult(): mixed
      {
          return $this->hydrate->one();
      }







      /**
       * @return array
      */
      public function getArrayResult(): array
      {
          return $this->hydrate->assoc();
      }





      /**
       * @return array
      */
      public function getArrayColumns(): array
      {
           return $this->hydrate->columns();
      }
}