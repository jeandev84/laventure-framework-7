<?php
namespace Laventure\Component\Database\Schema;


use Closure;

/**
 * @SchemaInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema
*/
interface SchemaInterface
{

     /**
      * Create schema
      *
      * @param string $table
      *
      * @param Closure $closure
      *
      * @return mixed
     */
     public function create(string $table, Closure $closure): mixed;






     /**
      * Update schema
      *
      * @param string $table
      *
      * @param Closure $closure
      *
      * @return mixed
     */
     public function update(string $table, Closure $closure): mixed;






     /**
      * Drop schema
      *
      * @param string $table
      *
      * @return mixed
     */
     public function drop(string $table): mixed;






     /**
      * Drop schema if exists
      *
      * @param string $table
      *
      * @return mixed
     */
     public function dropIfExists(string $table): mixed;





     /**
      * Truncate table
      *
      * @param string $table
      *
      * @return mixed
     */
     public function truncate(string $table): mixed;






     /**
      * Truncate table cascade
      *
      * @param string $table
      *
      * @return mixed
     */
     public function truncateCascade(string $table): mixed;







      /**
       * Describe table columns
       *
       * @param string $table
       *
       * @return mixed
      */
      public function describe(string $table): mixed;








     /**
      * Returns table columns
      *
      * @param string $table
      *
      * @return array
     */
     public function columns(string $table): array;







     /**
      * Determine if schema exists
      *
      * @param string $table
      *
      * @return bool
     */
     public function exists(string $table): bool;








     /**
      * Return database tables
      *
      * @return array
     */
     public function getTables(): array;

}