<?php
namespace Laventure\Component\Routing\Route\Cache;

use Laventure\Component\Routing\Route\Route;

/**
 * @RouteCacheInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Cache
*/
interface RouteCacheInterface
{
    /**
     * @param string $key
     *
     * @param Route $route
     *
     * @return mixed
    */
    public function cacheRoute(string $key, Route $route): mixed;




    /**
     * @param string $key
     *
     * @return bool
    */
    public function hasRoute(string $key): bool;





    /**
     * @param string $key
     *
     * @return Route|null
    */
    public function getRoute(string $key): ?Route;
}