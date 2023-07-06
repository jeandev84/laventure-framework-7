<?php
namespace Laventure\Component\Routing\Route;

use Closure;

/**
 * @RouteGroup
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Group
*/
class RouteGroup implements RouteGroupInterface
{

    /**
     * @var string|null
    */
    protected ?string $namespace;



    /**
     * @var array
    */
    protected array $path = [];



    /**
     * @var array
    */
    protected array $module = [];




    /**
     * @var array
    */
    protected array $name = [];




    /**
     * @var array
    */
    protected array $middlewares = [];




    /**
     * @param string $namespace
    */
    public function __construct(string $namespace = '')
    {
        $this->namespace($namespace);
    }





    /**
     * @param string $namespace
     *
     * @return $this
    */
    public function namespace(string $namespace): static
    {
        $this->namespace = $namespace;

        return $this;
    }






    /**
     * @param array $attributes
     *
     * @return $this
    */
    public function attributes(array $attributes): static
    {
          foreach ($attributes as $name => $value) {
              if (property_exists($this, $name)) {
                  call_user_func($name, $value);
              }
          }

          return $this;
    }





    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path[] = trim($path, '/');

        return $this;
    }




    /**
     * @return string
    */
    public function getPath(): string
    {
        return join('/', $this->path);
    }





    /**
     * @param string $module
     *
     * @return $this
    */
    public function module(string $module): static
    {
         $this->module[] = trim($module, '\\') . "\\";

         return $this;
    }




    /**
     * @return string
    */
    public function getModule(): string
    {
         return join($this->module);
    }





    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name[] = $name;

        return $this;
    }




    /**
     * @return string
    */
    public function getName(): string
    {
        return join($this->name);
    }





    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
         $this->middlewares = array_merge($this->middlewares, $middlewares);

        return $this;
    }





    /**
     * @return array
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }





    /**
     * @inheritDoc
    */
    public function map(Closure $routes, array $arguments = []): void
    {
         call_user_func_array($routes, $arguments);
    }






    /**
     * @inheritDoc
    */
    public function rewind(): void
    {
        $this->path   = [];
        $this->module = [];
        $this->middlewares = [];
        $this->name = [];
    }





    /**
     * @return string
    */
    public function getNamespace(): string
    {
        if (! $this->namespace) {
             return '';
        }

        $namespace = trim($this->namespace, '\\');

        return sprintf('%s\\%s', $namespace , $this->getModule());
    }





    /**
     * @return array
    */
    public function getPrefixes(): array
    {
        return [
            'path'        => $this->getPath(),
            'namespace'   => $this->getNamespace(),
            'name'        => $this->getName()
        ];
    }
}