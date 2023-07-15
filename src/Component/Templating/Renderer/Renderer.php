<?php
namespace Laventure\Component\Templating\Renderer;


use Laventure\Component\Templating\Template\Cache\TemplateCache;
use Laventure\Component\Templating\Template\Cache\TemplateCacheInterface;
use Laventure\Component\Templating\Template\Engine\TemplateEngine;
use Laventure\Component\Templating\Template\Engine\TemplateEngineInterface;
use Laventure\Component\Templating\Template\Layout\Layout;
use Laventure\Component\Templating\Template\Layout\LayoutInterface;
use Laventure\Component\Templating\Template\Template;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Renderer
*/
class Renderer implements RendererInterface
{


      /**
       * @var string
      */
      protected string $resourcePath;



      /**
       * @var string|null
      */
      protected ?string $layoutPath = null;




      /**
       * @var TemplateCacheInterface|null
      */
      protected ?TemplateCacheInterface $cache = null;




      /**
       * Globals parameters
       *
       * @var array
      */
      protected array $data = [];


      /**
       * @param string $resourcePath
       *
       * @param TemplateInterface|null $cache
      */
      public function __construct(string $resourcePath, TemplateInterface $cache = null)
      {
            $this->resourcePath($resourcePath);
            $this->cache($cache);
      }





      /**
        * @param TemplateCacheInterface|null $cache
        *
        * @return $this
      */
      public function cache(?TemplateCacheInterface $cache): static
      {
          $this->cache = $cache;

          return $this;
      }






      /**
       * @return bool
      */
      public function cacheable(): bool
      {
          return $this->cache instanceof TemplateCacheInterface;
      }





      /**
       * @param array $data
       *
       * @return $this
      */
      public function setGlobals(array $data): static
      {
          $this->data = array_merge($this->data, $data);

          return $this;
      }






      /**
       * @param string $resourcePath
       *
       * @return $this
      */
      public function resourcePath(string $resourcePath): static
      {
          $this->resourcePath = rtrim($resourcePath, DIRECTORY_SEPARATOR);

          return $this;
      }







      /**
       * @param string $layoutPath
       *
       * @return $this
      */
      public function layoutPath(string $layoutPath): static
      {
           $this->layoutPath = $layoutPath;

           return $this;
      }





      /**
       * @inheritDoc
      */
      public function render(string $path, array $data = []): string
      {
           $template = $this->createTemplate($path, $data);

           if ($this->cacheable()) {
               return $this->cacheTemplate($path, $template);
           }

           return $template;
      }







      /**
       * @param LayoutInterface $layout
       *
       * @return string
      */
      public function compile(LayoutInterface $layout): string
      {
            $engine = new TemplateEngine($layout);

            return $engine->compile();
      }





      /**
       * @param string $path
       *
       * @param array $parameters
       *
       * @return Template
      */
      public function createTemplate(string $path, array $parameters = []): Template
      {
          return new Template($this->locatePath($path), array_merge($this->data, $parameters));
      }





      /**
       * Returns full template path
       *
       * @param string $path
       *
       * @return string
      */
      public function locatePath(string $path): string
      {
           return $this->resourcePath . DIRECTORY_SEPARATOR. rtrim($path, DIRECTORY_SEPARATOR);
      }





      /**
       * @return TemplateCacheInterface|null
      */
      public function getCache(): ?TemplateCacheInterface
      {
          return $this->cache;
      }





      /**
       * @param string $key
       *
       * @param TemplateInterface $template
       *
       * @return string
     */
     private function cacheTemplate(string $key, TemplateInterface $template): string
     {
         if (! $this->layoutPath) {
             return $template;
         }

         $template = new Layout($this->locatePath($this->layoutPath), $template);

         return $this->cache->cache($key, $this->compile($template));
     }
}