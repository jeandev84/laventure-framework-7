<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML\Contract;

/**
 * @InsertBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands\DML\Contract
*/
interface InsertBuilderInterface
{


     /**
      * Insertion attributes
      *
      * @param array $attributes
      *
      * @return $this
     */
     public function attributes(array $attributes): static;





     /**
      * Returns insertion columns
      *
      * @return array
     */
     public function getColumns(): array;




     /**
      * Returns insertion values
      *
      * @return array
     */
     public function getValues(): array;




     /**
      * Execute insertion query
      *
      * @return mixed
     */
     public function execute(): mixed;
}