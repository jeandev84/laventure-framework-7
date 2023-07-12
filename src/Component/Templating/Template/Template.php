<?php
namespace Laventure\Component\Templating\Template;


/**
 * @Template
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Template
*/
class Template implements TemplateInterface
{


    /**
     * @var string
    */
    protected string $resource;



    /**
     * @var string
    */
    protected string $path;



    /**
     * @var string
    */
    protected string $extends = '';




    /**
     * @var array
    */
    protected array $parameters = [];




    /**
     * @var array
    */
    protected array $blocks = [];




    /**
     * @param string $path
     *
     * @param array $parameters
    */
    public function __construct(string $path, array $parameters = [])
    {
         $this->setPath($path);
         $this->setParameters($parameters);
    }




    /**
     * @param string $path
     *
     * @return $this
    */
    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }





    /**
     * @param array $parameters
     *
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
        $this->parameters = array_merge($this->parameters, $parameters);

        return $this;
    }





    /**
     * @param string $name
     *
     * @param $value
     *
     * @return $this
    */
    public function setParameter(string $name, $value): static
    {
         $this->parameters[$name] = $value;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
       return file_exists($this->path);
    }





    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }




    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }




    /**
     * @param Template $extends
     *
     * @return $this
    */
    public function extends(Template $extends): static
    {
        $this->extends = $extends;

        return $this;
    }





    /**
     * @return array
    */
    public function getBlocks(): array
    {
        $content = $this->getContent();

        $pattern = '/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return [];
        }

        foreach ($matches as $params) {
            $this->blocks[$params[1]] = $params[2];
        }

        return $this->blocks;
    }




    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasBlock(string $name): bool
    {
        return isset($this->blocks[$name]);
    }





    /**
     * @param string $name
     *
     * @return bool
    */
    public function emptyBlock(string $name): bool
    {
        return empty($this->blocks[$name]);
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->exists()) {
            $this->abortIf("template path: $this->path does not exist.");
        }

        extract($this->parameters, EXTR_SKIP);
        ob_start();
        require_once realpath($this->path);
        return ob_get_clean();
    }




    /**
     * @param string $message
     *
     * @param int $code
     *
     * @return mixed
    */
    public function abortIf(string $message, int $code = 500): mixed
    {
         return (function () use ($message, $code) {
               throw new TemplateException($message, $code);
         })();
    }





    /**
     * @return false|string
    */
    private function getContent(): bool|string
    {
        if (! $this->exists()) {
            $this->abortIf("template path: $this->path does not exist.");
        }

        extract($this->parameters, EXTR_SKIP);
        ob_start();
        require_once realpath($this->path);
        return ob_get_clean();
    }
}