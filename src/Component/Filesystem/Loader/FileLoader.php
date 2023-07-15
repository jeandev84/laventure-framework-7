<?php
namespace Laventure\Component\Filesystem\Loader;

use Laventure\Component\Filesystem\Loader\Contract\FileLoaderInterface;
use Laventure\Component\Filesystem\Locator\FileLocator;
use Laventure\Component\Filesystem\Locator\FileLocatorInterface;


/**
 * @inheritdoc
*/
class FileLoader implements FileLoaderInterface
{

    /**
     * @param FileLocator $locator
    */
    public function __construct(protected FileLocatorInterface $locator)
    {
    }



    /**
     * @inheritDoc
    */
    public function load(string $path): mixed
    {
        if (! $this->locator->exists($path)) {
            return false;
        }

        return require_once $this->locator->locate($path);
    }
}