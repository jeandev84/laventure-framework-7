<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Contract;

/**
 * @DeleteBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML
*/
interface DeleteBuilderInterface
{
    /**
     * Execute update query
     *
     * @return mixed
    */
    public function execute(): mixed;
}