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
    protected string $path;



    /**
     * @var array
    */
    protected array $parameters = [];



    /**
     * @var array
    */
    protected array $tags = [];




    /**
     * @var array
    */
    protected array $patterns = [];





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
        $this->parameters = $parameters;

        return $this;
    }


    /**
     * @param array $tags
     *
     * @return Template
    */
    public function setTags(array $tags): static
    {
         $this->tags = array_merge($this->tags, $tags);

         return $this;
    }




    /**
     * @return array
    */
    public function getTags(): array
    {
        return $this->tags;
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
        return realpath($this->path);
    }







    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }






    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->exists()) {
            $this->abortIf("template : $this->path does not exist.");
        }

        extract($this->parameters, EXTR_SKIP);
        ob_start();
        require_once $this->getPath();
        $content = ob_get_clean();

        return $this->replaceTags($content);
    }





    /**
     * @param string $content
     *
     * @return string
    */
    public function replaceTags(string $content): string
    {
        $keys   = array_keys($this->tags);
        $values = array_values($this->tags);

        return str_replace($keys, $values, $content);
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
}