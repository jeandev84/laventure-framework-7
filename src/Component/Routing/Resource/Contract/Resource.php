<?php
namespace Laventure\Component\Routing\Resource\Contract;


use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router;


/**
 * @Resource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource\Contract
*/
abstract class Resource
{

    /**
     * @var string
    */
    protected $name;




    /**
     * @var string
    */
    protected $controller;



    /**
     * @var array
    */
    protected array $routesParams = [];



    /**
     * @var Route[]
    */
    protected array $routes = [];




    /**
     * @param string $name
     * @param string $controller
    */
    public function __construct(string $name, string $controller)
    {
        $this->name       = strtolower($name);
        $this->controller = $controller;
    }






    /**
     * @param Router $router
     *
     * @return $this
    */
    public function map(Router $router): static
    {
        foreach ($this->getRouteParams() as $route) {
            $this->routes[] = $router->map(
                $route['methods'],
                $this->path($route['path']),
                $this->action($route['action']),
                $this->name($route['action'])
            )->wheres($route['patterns']);
        }

        return $this;
    }






    /**
     * @return string
    */
    public function getController(): string
    {
        return $this->controller;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @return Route[]
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }






    /**
     * @param string $path
     *
     * @return string
     */
    private function path(string $path = ''): string
    {
        return "/{$this->name}$path";
    }






    /**
     * @param string $action
     *
     * @return array|string
    */
    private function action(string $action): array|string
    {
        if (class_exists($this->controller)) {
            return [$this->controller, $action];
        }

        return "$this->controller@$action";
    }





    /**
     * @param string $name
     * @return string
     */
    private function name(string $name): string
    {
        return "$this->name.$name";
    }





    /**
     * @return array
    */
    abstract protected function getRouteParams(): array;






    /**
     * @return string
    */
    abstract public function getType(): string;
}