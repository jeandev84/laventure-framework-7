<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract;

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
class Query
{

      /**
       * @param QueryResultInterface $fetch
      */
      public function __construct(protected QueryResultInterface $fetch)
      {
      }





      /**
       * Returns all records
       *
       * @return array|mixed
      */
      public function getResult(): mixed
      {
          return $this->fetch->all();
      }





      /**
       * @return mixed
      */
      public function getOneOrNullResult(): mixed
      {
          return $this->fetch->one();
      }




      /**
       * @return array
      */
      public function getArrayResult(): array
      {
          return $this->fetch->assoc();
      }



}