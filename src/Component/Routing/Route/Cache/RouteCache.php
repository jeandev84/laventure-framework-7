<?php
namespace Laventure\Component\Routing\Route\Cache;

use Laventure\Component\Routing\Route\Route;

/**
 * @RouteCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Cache
*/
class RouteCache implements RouteCacheInterface
{


    /**
     * @var string
    */
    protected $cacheDir;




    /**
     * @param string $cacheDir
    */
    public function __construct(string $cacheDir = '')
    {
        $this->cacheDir($cacheDir);
    }




    /**
     * @param string $cacheDir
     *
     * @return $this
    */
    public function cacheDir(string $cacheDir): static
    {
        $this->cacheDir = rtrim($cacheDir, DIRECTORY_SEPARATOR);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function cacheRoute(string $key, Route $route): int|bool
    {
        $filename = $this->cachePath($key);
        $dirname = dirname($filename);

        if (! is_dir($dirname)) {
            mkdir($dirname, 0777, true);
        }

        touch($filename);

        return file_put_contents($filename, serialize($route).PHP_EOL, FILE_APPEND);
    }






    /**
     * @inheritDoc
    */
    public function hasRoute(string $key): bool
    {
        return file_exists($this->cachePath($key));
    }





    /**
     * @inheritDoc
    */
    public function getRoute(string $key): ?Route
    {
        if(! $content = file_get_contents($this->cachePath($key))) {
             return null;
        }

        if (! $this->hasRoute($key)) {
            return null;
        }

        return unserialize($content);
    }






    /**
     * @param string $key
     *
     * @return string
    */
    public function cachePath(string $key): string
    {
        return join(DIRECTORY_SEPARATOR, [$this->cacheDir, md5($key). '.cache']);
    }
}