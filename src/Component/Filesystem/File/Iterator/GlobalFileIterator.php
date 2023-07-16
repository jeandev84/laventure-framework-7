<?php
namespace Laventure\Component\Filesystem\File\Iterator;

use CallbackFilterIterator;
use Closure;

/**
 * @GlobalFileIterator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\File\Iterator
*/
class GlobalFileIterator extends \GlobIterator
{
    /**
     * @param Closure $closure
     *
     * @return CallbackFilterIterator
    */
    public function getRecursiveFiles(Closure $closure): CallbackFilterIterator
    {
        return new CallbackFilterIterator($this, $closure);
    }
}