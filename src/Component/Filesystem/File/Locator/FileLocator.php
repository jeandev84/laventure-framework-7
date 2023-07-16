<?php
namespace Laventure\Component\Filesystem\File\Locator;


/**
 * @inheritDoc
*/
class FileLocator implements FileLocatorInterface
{


    /**
     * @var string
    */
    protected string $resource;



    /**
     * FileLoader constructor.
     *
     * @param string $resource
    */
    public function __construct(string $resource)
    {
        $this->resource($resource);
    }




    /**
     * @param string $resource
     *
     * @return $this
    */
    public function resource(string $resource): static
    {
        $resource = rtrim($resource, DIRECTORY_SEPARATOR);

        $this->resource = $resource;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function locate(string $path): string
    {
        return join(DIRECTORY_SEPARATOR, [realpath($this->resource), $this->normalizePath($path)]);
    }






    /**
     * @param string $path
     *
     * @return string
    */
    public function normalizePath(string $path): string
    {
        return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, trim($path, '\\/'));
    }
}