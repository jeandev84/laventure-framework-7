<?php
namespace Laventure\Component\Templating\Renderer;


use Laventure\Component\Templating\Template\Cache\TemplateCache;
use Laventure\Component\Templating\Template\Cache\TemplateCacheInterface;
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
      protected ?string $layoutPath = '';



      /**
       * @var TemplateCacheInterface|null
      */
      protected ?TemplateCacheInterface $cache = null;



      /**
       * @var array
      */
      protected array $tags = [];




      /**
       * Globals parameters
       *
       * @var array
      */
      protected array $data = [];



      /**
       * @param string $resourcePath
      */
      public function __construct(string $resourcePath)
      {
            $this->resourcePath($resourcePath);
      }




      /**
       * @param TemplateCacheInterface $cache
       *
       * @return $this
      */
      public function cache(TemplateCacheInterface $cache): static
      {
          $this->cache = $cache;

          return $this;
      }





     /**
      * @param array $tags
      *
      * @return $this
     */
     public function setTags(array $tags): static
     {
         $this->tags = array_merge($this->tags, $tags);

         return $this;
     }





      /**
       * @param array $data
       *
       * @return $this
      */
      public function setGlobals(array $data): static
      {
          $this->data = $data;

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
          $template = $this->createLayoutFromTemplate($this->createTemplate($path, $data));

          return $this->cacheTemplate($path, $template);
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
          $parameters = array_merge($parameters, $this->data);
          $template   = new Template($this->locatePath($path), $parameters);
          $template->setTags($this->tags);

          return $template;
      }






      /**
       * @param Template $template
       *
       * @return Template
     */
      public function createLayoutFromTemplate(Template $template): Template
      {
           if (! $this->layoutPath) {
              return $template;
           }

           return $this->createTemplate($this->layoutPath, ['content' => $template->__toString()]);
      }







      /**
       * @param string $key
       *
       * @param Template $template
       *
       * @return string
      */
      public function cacheTemplate(string $key, Template $template): string
      {
          if (! $this->cacheable()) {
               return $template;
          }

          $this->cache->cacheTemplate($key, $template);

          return $this->cache->getTemplate($key);
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
       * @return bool
      */
      public function cacheable(): bool
      {
          return $this->cache instanceof TemplateCacheInterface;
      }






     /**
      * @return TemplateCacheInterface|null
     */
     public function getCache(): ?TemplateCacheInterface
     {
         return $this->cache;
     }
}