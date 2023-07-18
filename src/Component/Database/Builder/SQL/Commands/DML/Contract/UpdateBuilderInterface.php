<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;

/**
 * @UpdateBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract
*/
interface UpdateBuilderInterface
{


     /**
      * Execute update query
      *
      * @return mixed
     */
     public function execute(): mixed;
}