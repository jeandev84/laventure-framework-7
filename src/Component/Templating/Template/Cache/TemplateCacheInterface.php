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
      *
      * @param TemplateInterface $template
      *
      * @return mixed
     */
     public function cacheTemplate(string $key, TemplateInterface $template);




     /**
      * @param string $key
      *
      * @return bool
     */
     public function exists(string $key): bool;




     /**
      * @param string $key
      *
      * @return string
     */
     public function getTemplate(string $key): string;
}