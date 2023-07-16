<?php
namespace Laventure\Component\Filesystem\Loader;

use Laventure\Component\Filesystem\File\Loader\Contract\FileLoaderInterface;
use Laventure\Component\Filesystem\File\Locator\FileLocatorInterface;



/**
 * @inheritdoc
*/
class FileLoader implements FileLoaderInterface
{

    /**
     * @param FileLocatorInterface $locator
    */
    public function __construct(protected FileLocatorInterface $locator)
    {
    }




    /**
     * @inheritDoc
    */
    public function load(string $path): mixed
    {
        return require_once $this->locator->locate($path);
    }
}