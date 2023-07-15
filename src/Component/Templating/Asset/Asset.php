<?php
namespace Laventure\Component\Templating\Asset;


/**
 * @Asset
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Asset
*/
class Asset implements AssetInterface
{

    /**
     * @var string
    */
    protected string $url;




    /**
     * @var array
    */
    protected array $styles = [];




    /**
     * @var array
    */
    protected array $scripts = [];





    /**
     * @param string $url
    */
    public function __construct(string $url = '/')
    {
         $this->url($url);
    }





    /**
     * @param string $url
     *
     * @return $this
    */
    public function url(string $url): static
    {
        $this->url = rtrim($url, '/');

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function path(string $path): string
    {
        return  $this->url . '/' . trim($path, '/');
    }






    /**
     * @param string $style
     *
     * @return $this
    */
    public function addStyle(string $style): static
    {
         $this->styles[] = $style;

         return $this;
    }





    /**
     * @param string $script
     *
     * @return $this
    */
    public function addScript(string $script): static
    {
        $this->scripts[] = $script;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getStyles(): array
    {
        return $this->styles;
    }






    /**
     * @inheritDoc
    */
    public function renderStyles(): string
    {
         return join(PHP_EOL, $this->styles);
    }





    /**
     * @inheritDoc
    */
    public function getScripts(): array
    {
        return $this->scripts;
    }





    /**
     * @inheritDoc
    */
    public function renderScripts(): string
    {
        return join(PHP_EOL, $this->scripts);
    }





    /**
     * @param array $stylesheets
     *
     * @return $this
    */
    public function css(array $stylesheets): static
    {
         foreach ($stylesheets as $stylesheet) {
              $this->addStyle(sprintf('<link href="%s" rel="stylesheet">', $this->path($stylesheet)));
         }

         return $this;
    }






    /**
     * @param array $scripts
     *
     * @return $this
    */
    public function js(array $scripts): static
    {
          foreach ($scripts as $script) {
              $this->addScript(sprintf('<script src="%s" type="application/javascript"></script>', $this->path($script)));
          }

          return $this;
    }





    /**
     * @inheritDoc
    */
    public function baseUrl(): string
    {
        return $this->url;
    }
}