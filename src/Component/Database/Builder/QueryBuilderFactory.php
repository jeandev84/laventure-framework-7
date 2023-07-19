<?php
namespace Laventure\Component\Database\Builder;

use Laventure\Component\Database\Builder\SQL\SqlQueryBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * @QueryBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder
*/
class QueryBuilderFactory
{

       /**
        * @param ConnectionInterface $connection
        *
        * @param string $table
        *
        * @return QueryBuilder
       */
       public static function make(ConnectionInterface $connection, string $table): QueryBuilder
       {
             return new QueryBuilder(new SqlQueryBuilder($connection, $table));
       }
}