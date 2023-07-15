<?php
namespace Laventure\Component\Filesystem\Loader\Contract;


/**
 * @FileLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Loader\Contract
*/
interface FileLoaderInterface
{
    /**
     * @param string $path
     *
     * @return mixed
    */
    public function load(string $path): mixed;
}