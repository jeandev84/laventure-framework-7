<?php
namespace Laventure\Component\Templating\Template;

class TemplateFactory
{

     /**
      * @param string $path
      *
      * @param array $parameters
      *
      * @return Template
     */
     public function createTemplate(string $path, array $parameters = []): Template
     {
         return new Template($path, $parameters);
     }
}