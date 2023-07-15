<?php
namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Layout\LayoutInterface;
use Laventure\Component\Templating\Template\Template;
use Laventure\Component\Templating\Template\TemplateInterface;


/**
 * @TemplateEngine
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Template\Engine
*/
class TemplateEngine implements TemplateEngineInterface
{


    /**
     * @var array
    */
    protected array $blocks = [];



    /**
     * @param string $resourcePath
    */
    public function __construct(protected string $resourcePath)
    {
    }




    /**
     * @inheritDoc
    */
    public function compile(TemplateInterface $template): string
    {
         $content = $this->includePaths($template);

         dd($content);
    }





    /**
     * @param TemplateInterface $template
     *
     * @return string
    */
    private function includePaths(TemplateInterface $template)
    {
        $pattern = '/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i';
        $content = $template->getContent();

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $value) {
            $content = str_replace($value[0], $this->includePaths(new Template($this->path($value[2]))), $content);
        }

        return preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $content);
    }



    private function compileYields(TemplateInterface $template): string
    {
        $blocks   = $this->getBlocks($template);
        $extends  = new Template($this->extendsPath($template), $template->getParameters());

        dd($extends->getContent());

        foreach ($blocks as $name => $content) {

        }

        dump($blocks);
        dd($extends);
    }




    /**
     * @param TemplateInterface $template
     *
     * @return array
    */
    private function getBlocks(TemplateInterface $template): array
    {
        $pattern = '/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is';

        preg_match_all($pattern, $template->getContent(), $matches, PREG_SET_ORDER);

        $blocks = [];

        foreach ($matches as $item) {
             $blocks[$item[1]] = $item[2];
        }

        return $blocks;
    }





    /**
     * @param string $path
     *
     * @return string
    */
    private function path(string $path)
    {
        return $this->resourcePath . '/' . trim($path, '/');
    }



    /**
     * @param TemplateInterface $template
     *
     * @return string
    */
    private function extendsPath(TemplateInterface $template): string
    {
        /*
        preg_match("/{%\sextends(.*)\s%}/i", $template->getContent(), $matches);

        if (empty($matches[1])) {
            return '';
        }

        return $this->path(trim(str_replace(["'", '"'], '', $matches[1])));
        */


        preg_match_all('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', $template->getContent(), $matches, PREG_SET_ORDER);

        dd($matches);
    }






//    /**
//     * @param string $path
//     *
//     * @return string|false
//    */
//    private function content(string $path): string|false
//    {
//        return file_get_contents($this->path($path));
//    }

}