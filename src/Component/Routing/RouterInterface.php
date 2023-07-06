<?php
namespace Laventure\Component\Routing;


use Laventure\Component\Routing\Route\Route;

/**
 * @Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing
*/
interface RouterInterface
{


       /**
        * @return array
       */
       public function getRoutes(): array;






      /**
       * @param string $method
       *
       * @param string $path
       *
       * @return mixed
      */
      public function match(string $method, string $path): mixed;








      /**
       * Generate route URI
       *
       * @param string $name
       *
       * @param array $parameters
       *
       * @return string|null
      */
      public function generate(string $name, array $parameters = []): ?string;
}