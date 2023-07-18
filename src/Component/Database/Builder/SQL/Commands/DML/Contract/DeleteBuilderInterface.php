<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;

/**
 * @DeleteBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML
*/
interface DeleteBuilderInterface
{

     /**
      * Returns execute query
      *
      * @return mixed
     */
     public function execute(): mixed;
}