<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Contract;

/**
 * @UpdateBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DQL\Contract
*/
interface UpdateBuilderInterface
{


     /**
      * @param array $attributes
      *
      * @return $this
     */
     public function attributes(array $attributes): static;





     /**
      * Execute update query
      *
      * @return mixed
     */
     public function execute(): mixed;
}