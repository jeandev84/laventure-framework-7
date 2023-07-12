<?php
namespace Laventure\Component\Templating\Compiler;

use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @TemplateCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Compiler
*/
class TemplateCompiler implements TemplateCompilerInterface
{

    /**
     * @var string
    */
    protected string $extends = '';



    /**
     * @var array
    */
    protected array $blocks = [];




    /**
     * @inheritDoc
    */
    public function compileTemplate(TemplateInterface $template): TemplateInterface
    {

    }




    /**
     * @param $template
     *
     * @return array
    */
    private function compileBlocks($template): array
    {
        $pattern = '/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is';

        preg_match_all($pattern, $template, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return [];
        }

        foreach ($matches as $params) {
            $this->blocks[$params[1]] = $params[2];
        }

        return $this->blocks;
    }




    /**
     * @param $template
     *
     * @return array
    */
    private function getBlocks($template): array
    {
        $pattern = '/{% ?block ?(.*?) ?%}(.*?){% ?endblock ?%}/is';

        preg_match_all($pattern, $template, $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return [];
        }

        foreach ($matches as $params) {
            $this->blocks[$params[1]] = $params[2];
        }

        return $this->blocks;
    }
}