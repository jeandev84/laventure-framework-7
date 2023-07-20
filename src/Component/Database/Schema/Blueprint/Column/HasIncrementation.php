<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column;


/**
 * @Column
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema\Blueprint\Column
*/
interface HasIncrementation
{

     /**
      * @return mixed
     */
     public function autoincrement(): mixed;
}