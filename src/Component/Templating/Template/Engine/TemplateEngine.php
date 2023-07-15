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
         $content = $this->compileBlocks($content);
         $content = $this->compileYields($content);
         $content = $this->compileEscapedEchos($content);
         $content = $this->compileEchos($content);

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





    /**
     * @param string $content
     *
     * @return string
    */
    private function compileBlocks(string $content): string
    {
        $pattern = '/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $value) {
             if (! array_key_exists($value[1], $this->blocks)) { $this->blocks[$value[1]] = ''; }
             if (str_contains($value[2], '@parent') === false) {
                 $this->blocks[$value[1]] = $value[2];
             } else {
                 $this->blocks[$value[1]] = str_replace('@parent', $this->blocks[$value[1]], $value[2]);
             }
             $content = str_replace($value[0], '', $content);
        }

        return $content;
    }





    /**
     * @param string $content
     *
     * @return string
    */
    private function compileYields(string $content): string
    {
         foreach ($this->blocks as $name => $value) {
             $content = preg_replace("/{% yield ?$name ?%}/", $value, $content);
         }

         return $content;
    }



    /**
     * @param string $content
     * @return string
    */
    private function compileEscapedEchos(string $content): string
    {
        return preg_replace('~\{{{\s*(.+?)\s*\}}}~is', '<?php echo htmlentities($1, ENT_QUOTES, \'UTF-8\') ?>', $content);
    }




    /**
     * @param string $content
     *
     * @return string
    */
    private function compileEchos(string $content): string
    {
        return preg_replace('~\{{\s*(.+?)\s*\}}~is', '<?php echo $1 ?>', $content);
    }





    /**
     * @param string $path
     *
     * @return string
    */
    private function path(string $path)
    {
        $path = str_replace('/', DIRECTORY_SEPARATOR, trim($path, '/'));

        return $this->resourcePath . DIRECTORY_SEPARATOR . $path;
    }

}