<?php
namespace Laventure\Component\Routing\Route;


use Closure;

/**
 * @RouteGroupInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Group
*/
interface RouteGroupInterface
{

      /**
       * Mapped routes
       *
       * @param Closure $routes
       *
       * @param array $arguments
       *
       * @return void
      */
      public function map(Closure $routes, array $arguments = []): void;






      /**
       * @return void
      */
      public function rewind(): void;
}