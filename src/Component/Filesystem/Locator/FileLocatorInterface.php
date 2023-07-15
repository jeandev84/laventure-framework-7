<?php
namespace Laventure\Component\Filesystem\Locator;


/**
 * @FileLocator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Locator
 */
interface FileLocatorInterface
{

    /**
     * Localize full path
     *
     * @param string $path
     *
     * @return string
    */
    public function locate(string $path): string;




    /**
     * @param string $path
     *
     * @return bool
    */
    public function exists(string $path): bool;
}