<?php
namespace Laventure\Component\Templating\Template\Factory;

use Laventure\Component\Templating\Template\Layout\Layout;
use Laventure\Component\Templating\Template\Template;
use Laventure\Component\Templating\Template\TemplateInterface;

class TemplateFactory
{

     /**
      * @param string $path
      *
      * @param array $parameters
      *
      * @return TemplateInterface
     */
     public function createTemplate(string $path, array $parameters = []): TemplateInterface
     {
         #return new Template($path, $parameters);
     }




     /**
      * @param string $path
      *
      * @param Template $template
      *
      * @return Layout
     */
     public function createLayout(string $path, Template $template): Layout
     {
         # return new Layout($path, $template);
     }
}