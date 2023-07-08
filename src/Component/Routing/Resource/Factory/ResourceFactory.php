<?php
namespace Laventure\Component\Routing\Resource\Factory;

use Laventure\Component\Routing\Resource\ApiResource;
use Laventure\Component\Routing\Resource\WebResource;


/**
 * @ResourceFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource\Factory
*/
class ResourceFactory
{
      /**
       * @param string $name
       *
       * @param string $controller
       *
       * @return WebResource
     */
     public function createWebResource(string $name, string $controller): WebResource
     {
         return new WebResource($name, $controller);
     }




     /**
      * @param string $name
      *
      * @param string $controller
      *
      * @return ApiResource
     */
     public function createApiResource(string $name, string $controller): ApiResource
     {
          return new ApiResource($name, $controller);
     }
}