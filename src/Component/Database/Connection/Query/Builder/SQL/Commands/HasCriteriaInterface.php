<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Commands;


/**
 * @HasCriteriaInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Builder\SQL\Commands
*/
interface HasCriteriaInterface
{
    /**
     * Add conditions
     *
     * @param array $wheres
     *
     * @return $this
    */
    public function criteria(array $wheres): static;
}