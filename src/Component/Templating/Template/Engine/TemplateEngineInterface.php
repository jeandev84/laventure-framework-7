<?php
namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @TemplateEngineInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Template\Engine
*/
interface TemplateEngineInterface
{


      /**
       * @param string $resourcePath
       *
       * @return static
      */
      public function resourcePath(string $resourcePath): static;





      /**
       * Returns full path of template
       *
       * @param string $path
       *
       * @return string
      */
      public function locatePath(string $path): string;






      /**
       * Compile template
       *
       * @param TemplateInterface $template
       * @return TemplateInterface|string
      */
      public function compile(TemplateInterface $template): TemplateInterface|string;






     /**
      * @param string $key
      *
      * @param TemplateInterface $template
      *
      * @return TemplateInterface
     */
     public function cache(string $key, TemplateInterface $template): TemplateInterface;
}