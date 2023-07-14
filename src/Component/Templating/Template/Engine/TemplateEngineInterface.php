<?php
namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Layout\LayoutInterface;
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
       * Returns layout object
       *
       * @return LayoutInterface
      */
      public function getLayout(): LayoutInterface;



      /**
       * Returns template object
       *
       * @return TemplateInterface
      */
      public function getTemplate(): TemplateInterface;



      /**
       * Compile php code
       *
       * @return string
      */
      public function compile(): string;
}