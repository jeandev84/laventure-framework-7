<?php
namespace Laventure\Component\Templating\Renderer;


use Laventure\Component\Templating\Template\Compressor\TemplateCompressor;
use Laventure\Component\Templating\Template\Engine\TemplateEngine;
use Laventure\Component\Templating\Template\Engine\TemplateEngineInterface;
use Laventure\Component\Templating\Template\Template;



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
       * @var TemplateEngineInterface
      */
      protected TemplateEngineInterface $engine;



      /**
       * @var TemplateCompressor
      */
      protected TemplateCompressor $compressor;



      /**
       * @var bool
      */
      protected bool $compressed = false;



      /**
       * Globals parameters
       *
       * @var array
      */
      protected array $data = [];




      /**
       * @param TemplateEngine $engine
      */
      public function __construct(TemplateEngineInterface $engine, bool $compressed = false)
      {
           $this->engine     = $engine;
           $this->compressed = $compressed;
           $this->compressor = new TemplateCompressor();
      }





      /**
       * @param bool $compressed
       *
       * @return $this
      */
      public function compress(bool $compressed): static
      {
           $this->compressed = $compressed;

           return $this;
      }





      /**
       * @param string $resourcePath
       *
       * @return $this
      */
      public function resourcePath(string $resourcePath): static
      {
          $this->engine->resourcePath($resourcePath);

          return $this;
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
           return $this->engine->locateTemplate($path);
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
       * @inheritDoc
      */
      public function render(string $path, array $data = []): string
      {
           $template = $this->engine->cache($path, $this->createTemplate($path, $data));

           if (! $this->compressed) {
                return $template;
           }

           return $this->compressor->compress($template);
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
}