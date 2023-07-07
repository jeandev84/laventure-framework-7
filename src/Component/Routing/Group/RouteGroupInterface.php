<?php
namespace Laventure\Component\Routing\Group;


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
       * Map routes
       *
       * @param Closure $routes
       *
       * @param array $arguments
       *
       * @return void
      */
      public function call(Closure $routes, array $arguments = []): void;





      /**
       * Reset group
       *
       * @return void
      */
      public function rewind(): void;





      /**
       * Return attributes
       *
       * @return array
      */
      public function getAttributes(): array;
}