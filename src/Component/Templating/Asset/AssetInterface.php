<?php
namespace Laventure\Component\Templating\Asset;


/**
 * @AssetInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Asset
*/
interface AssetInterface
{


      /**
       * @param string $path
       *
       * @return string
      */
      public function path(string $path): string;






      /**
       * Returns styles
       *
       * @return mixed
      */
      public function getStyles();






      /**
       * @return mixed
      */
      public function renderStyles();




      /**
       * Return scripts
       *
       * @return mixed
      */
      public function getScripts();






     /**
      * @return mixed
     */
     public function renderScripts();
}