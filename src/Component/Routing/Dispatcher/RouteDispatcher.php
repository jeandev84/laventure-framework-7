<?php
namespace Laventure\Component\Routing\Dispatcher;


use Laventure\Component\Routing\Route\Route;

/**
 * @RouteDispatcher
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Dispatcher
*/
class RouteDispatcher implements RouteDispatcherInterface
{

    /**
     * @inheritDoc
    */
    public function dispatchRoute(Route $route)
    {
        if ($route->hasController()) {

            $controller = $route->getController();
            $action     = $route->getActionName();

            $route->callback([new $controller, $action]);
        }

        return $route->callAction();
    }
}