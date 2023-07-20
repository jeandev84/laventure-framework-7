<?php
namespace Laventure\Component\Database\Schema\Blueprint;


/**
 * @Printable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Schema\Blueprint
*/
interface Printable
{

    /**
     * @return string
    */
    public function __toString(): string;
}