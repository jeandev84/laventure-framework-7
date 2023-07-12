<?php
namespace Laventure\Component\Templating\Template\Cache;


use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @TemplateCacheInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Template\Cache
*/
interface TemplateCacheInterface
{

      /**
       * @param string $key
       * @param TemplateInterface $template
       *
       * @return string
      */
      public function cacheTemplate(string $key, TemplateInterface $template): string;
}