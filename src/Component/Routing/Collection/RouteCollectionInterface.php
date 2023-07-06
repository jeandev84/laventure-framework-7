<?php
namespace Laventure\Component\Routing\Collection;

use Laventure\Component\Routing\Route\Route;


/**
 * @RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
interface RouteCollectionInterface
{
      /**
       * @return Route[]
      */
      public function getRoutes(): array;
}