<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract;



/**
 * @SelectQueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DQL\Contract
*/
interface QueryHydrateInterface
{
    /**
     * Returns all records
     *
     * @return array|mixed
    */
    public function getResult(): mixed;



    /**
     * Returns one or null result
     *
     * @return mixed
    */
    public function getOneOrNullResult(): mixed;




    /**
     * Returns array result
     *
     * @return array
    */
    public function getArrayResult(): array;





    /**
     * Returns all columns
     *
     * @return array
    */
    public function getArrayColumns(): array;
}