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
       * Compile template
       *
       * @param TemplateInterface $template
       * @return string
      */
      public function compile(TemplateInterface $template): string;
}