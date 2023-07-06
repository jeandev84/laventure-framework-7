<?php
namespace Laventure\Component\Routing\Collection;

use Laventure\Component\Routing\Route\Route;


/**
 * @RouteCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Collection
*/
class RouteCollection implements RouteCollectionInterface
{

       /**
        * @var Route[]
       */
       protected array $routes = [];



       /**
        * @var Route[]
       */
       protected array $methods = [];




       /**
        * @var Route[]
       */
       protected $controllers = [];





       /**
        * @var Route[]
       */
       protected array $namedRoutes = [];





       /**
        * @param Route[] $routes
       */
       public function __construct(array $routes = [])
       {
            $this->addRoutes($routes);
       }






       /**
        *  @param Route $route
        *
        * @return Route
       */
       public function addRoute(Route $route): Route
       {
           $this->methods[$route->getMethod()][] = $route;

           if ($controller = $route->getController()) {
               $this->controllers[$controller][] = $route;
           }

           if ($name = $route->getName()) {
               $this->namedRoutes[$name][] = $route;
           }

           $this->routes[] = $route;

           return $route;
       }




       /**
        * @param Route[] $routes
        *
        * @return $this
       */
       public function addRoutes(array $routes): static
       {
            foreach ($routes as $route) {
                $this->addRoute($route);
            }

            return $this;
       }





       /**
        * @inheritdoc
       */
       public function getRoutes(): array
       {
           return $this->routes;
       }





       /**
        * @return Route[]
       */
       public function getRoutesByMethod(): array
       {
            return $this->methods;
       }




       /**
        * @return Route[]
       */
       public function getRoutesByController(): array
       {
            return $this->controllers;
       }





       /**
        * @return Route[]
       */
       public function getRoutesByName(): array
       {
            return $this->namedRoutes;
       }






      /**
       * @param string $name
       *
       * @return Route|null
      */
      public function getRouteByName(string $name): ?Route
      {
          return $this->namedRoutes[$name] ?? null;
      }

}