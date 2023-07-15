<?php
namespace Laventure\Component\Filesystem\Locator;


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
     * @param string $root
    */
    public function __construct(string $root)
    {
        $this->resource($root);
    }




    /**
     * @param string $resource
     *
     * @return $this
    */
    public function resource(string $resource): static
    {
        $resource = rtrim($resource, DIRECTORY_SEPARATOR);

        $this->resource = realpath($resource);

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function locate(string $path): string
    {
        return join(DIRECTORY_SEPARATOR, [$this->resource, $this->normalizePath($path)]);
    }




    /**
     * @param string $path
     *
     * @return bool
    */
    public function exists(string $path): bool
    {
        return file_exists($this->locate($path));
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