<?php
namespace Laventure\Component\Routing;


use Closure;
use Laventure\Component\Routing\Collection\RouteCollection;
use Laventure\Component\Routing\Resource\ApiResource;
use Laventure\Component\Routing\Resource\Contract\Resource;
use Laventure\Component\Routing\Resource\Types\ResourceType;
use Laventure\Component\Routing\Resource\WebResource;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Group\RouteGroup;
use Laventure\Component\Routing\Route\RouteException;


/**
 * @Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing
*/
class Router implements RouterInterface
{


    /**
     * Route collection
     *
     * @var RouteCollection
    */
    protected RouteCollection $collection;



    /**
     * Route group
     *
     * @var RouteGroup
    */
    protected RouteGroup $group;





    /**
     * Route domain
     *
     * @var string
    */
    protected string $domain;




    /**
     * @var Resource[]
    */
    public $resources = [];





    /**
     * Route patterns
     *
     * @var array
    */
    protected array $patterns = [
        'id' => '\d+'
    ];





    /**
     * Route middlewares
     *
     * @var array
    */
    protected array $middlewareStack = [];




    /**
     * @param string $domain
    */
    public function __construct(string $domain)
    {
         $this->collection = new RouteCollection();
         $this->group      = new RouteGroup();
         $this->domain     = $domain;
    }






    /**
     * @param string $namespace
     *
     * @return $this
    */
    public function namespace(string $namespace): static
    {
         $this->group->namespace($namespace);

         return $this;
    }





    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->group->path($path);

        return $this;
    }






    /**
     * @param string $module
     *
     * @return $this
    */
    public function module(string $module): static
    {
        $this->group->module($module);

        return $this;
    }






    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
        $this->group->name($name);

        return $this;
    }






    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewareStack(array $middlewares): static
    {
         $this->middlewareStack = array_merge($this->middlewareStack, $middlewares);

         return $this;
    }






    /**
     * @param array|string $middleware
     *
     * @return $this
    */
    public function middleware(array|string $middleware): static
    {
        $this->group->middlewares((array)$middleware);

        return $this;
    }






    /**
     * @param array $patterns
     *
     * @return $this
    */
    public function patterns(array $patterns): static
    {
        $this->patterns = array_merge($this->patterns, $patterns);

        return $this;
    }





    /**
     * @return RouteCollection
    */
    public function getCollection(): RouteCollection
    {
        return $this->collection;
    }






    /**
     * @inheritDoc
     *
     * @return Route[]
    */
    public function getRoutes(): array
    {
         return $this->collection->getRoutes();
    }





    /**
     * @return Resource[]
    */
    public function getResources(): array
    {
        return $this->resources;
    }




    /**
     * @return RouteGroup
    */
    public function getGroup(): RouteGroup
    {
        return $this->group;
    }






    /**
     * @return array
    */
    public function getPatterns(): array
    {
        return $this->patterns;
    }





    /**
     * @inheritdoc
    */
    public function getDomain(): string
    {
        return $this->domain;
    }






    /**
     * @return array
    */
    public function getMiddlewareStack(): array
    {
        return $this->middlewareStack;
    }






    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): Route|false
    {
         foreach ($this->getRoutes() as $route) {
              if ($route->match($method, $path)) {
                   return $route;
              }
         }

         return false;
    }






    /**
     * @inheritDoc
    */
    public function generate(string $name, array $parameters = []): ?string
    {
          if (! $route = $this->collection->getRouteByName($name)) {
               return null;
          }

          return $route->generateUri($parameters);
    }






    /**
     * @param Route $route
     *
     * @return Route
    */
    public function addRoute(Route $route): Route
    {
        return $this->collection->addRoute($route);
    }






    /**
     * @param Resource $resource
     *
     * @return $this
    */
    public function addResource(Resource $resource): static
    {
         $resource->map($this);

         $resourceType = $resource->getType();
         $resourceName = $resource->getName();

         $this->resources[$resourceType][$resourceName] = $resource;

         return $this;
    }







    /**
     * Map route
     *
     * @param $methods
     *
     * @param $path
     *
     * @param $action
     *
     * @param null $name
     *
     * @return Route
    */
    public function map($methods, $path, $action, $name = null): Route
    {
         return $this->addRoute($this->makeRoute($methods, $path, $action, $name));
    }







    /**
     * Map route called by method GET
     *
     * @param $path
     *
     * @param $action
     *
     * @param null $name
     *
     * @return Route
    */
    public function get($path, $action, $name = null): Route
    {
        return $this->map('GET', $path, $action, $name);
    }






    /**
     * Map route called by method POST
     *
     * @param $path
     *
     * @param $action
     *
     * @param null $name
     *
     * @return Route
    */
    public function post($path, $action, $name = null): Route
    {
        return $this->map('POST', $path, $action, $name);
    }







    /**
     * Map route called by method PUT
     *
     * @param $path
     *
     * @param $action
     *
     * @return Route
    */
    public function put($path, $action): Route
    {
        return $this->map('PUT', $path, $action);
    }







    /**
     * Map route called by method PATCH
     *
     * @param $path
     *
     * @param $action
     *
     * @param null $name
     *
     * @return Route
    */
    public function patch($path, $action, $name = null): Route
    {
        return $this->map('PATCH', $path, $action, $name);
    }







    /**
     * Map route called by method DELETE
     *
     * @param $path
     *
     * @param $action
     *
     * @param null $name
     *
     * @return Route
    */
    public function delete($path, $action, $name = null): Route
    {
        return $this->map('DELETE', $path, $action, $name);
    }







    /**
     * @param array $attributes
     *
     * @param Closure $routes
     *
     * @return $this
    */
    public function group(array $attributes, Closure $routes): static
    {
         $this->group->attributes($attributes);
         $this->group->call($routes, [$this]);
         $this->group->rewind();

         return $this;
    }






    /**
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
    */
    public function resource(string $name, string $controller): static
    {
        return $this->addResource(new WebResource($name, $controller));
    }





    /**
     * @param array $resources
     *
     * @return $this
    */
    public function resources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->resource($name, $controller);
        }

        return $this;
    }





    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasResource(string $name): bool
    {
        return isset($this->resources[ResourceType::WEB][$name]);
    }






    /**
     * @param string $name
     *
     * @return WebResource|null
    */
    public function getResource(string $name): ?WebResource
    {
        return $this->resources[ResourceType::WEB][$name] ?? null;
    }







    /**
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
     */
    public function apiResource(string $name, string $controller): static
    {
         return $this->addResource(new ApiResource($name, $controller));
    }






    /**
     * @param array $resources
     *
     * @return $this
    */
    public function apiResources(array $resources): static
    {
        foreach ($resources as $name => $controller) {
            $this->apiResource($name, $controller);
        }

        return $this;
    }






    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasApiResource(string $name): bool
    {
        return isset($this->resources[ResourceType::API][$name]);
    }





    /**
     * @param string $name
     *
     * @return ApiResource|null
    */
    public function getApiResource(string $name): ?ApiResource
    {
         return $this->resources[ResourceType::API][$name] ?? null;
    }







    /**
     * Create a new route
     *
     * @param string|array $methods
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @param string|null $name
     *
     * @return Route
    */
    public function makeRoute(string|array $methods, string $path, mixed $action, string $name = null): Route
    {
        $route = new Route($this->domain, $this->group->getPrefixes(), $this->middlewareStack);
        $route->methods($methods);
        $route->path($path);
        $route->action($action);
        $route->wheres($this->patterns);
        $route->name($name);
        $route->middleware($this->group->getMiddlewares());

        return $route;
    }

}