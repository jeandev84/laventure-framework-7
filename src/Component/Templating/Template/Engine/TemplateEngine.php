<?php
namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Layout\LayoutInterface;
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
     * @param LayoutInterface $layout
    */
    public function __construct(protected LayoutInterface $layout)
    {
    }




    /**
     * @inheritDoc
    */
    public function getLayout(): LayoutInterface
    {
         return $this->layout;
    }




    /**
     * @inheritDoc
    */
    public function getTemplate(): TemplateInterface
    {
        return $this->layout->getTemplate();
    }




    /**
     * @inheritDoc
    */
    public function compile(): string
    {
        $template = $this->getLayout();
        $template = $this->compileIncludes($template);
        $template = $this->compileYields($template);

        return $this->compilePHP($template);
    }





    /**
     * @param $layout
     *
     * @return string
    */
    private function compileYields($layout): string
    {
        $blocks = $this->getBlocks();

        // compile yields
        foreach ($blocks as $name => $content) {
            $layout = preg_replace("/@yield-$name/i", $content, $layout);
        }

        return $layout;
    }






    /**
     * @param $template
     *
     * @return string
    */
    private function compilePHP($template): string
    {
        $template = $this->compileEchos($template);
        $template = $this->compileLoop($template);
        $template = $this->compileIf($template);

        return $this->compileSwitch($template);
    }






    /**
     * @param $template
     *
     * @return string
    */
    private function compileEchos($template): string
    {
        return preg_replace('/{{(\s*(.*)\s*).}}/i', '<?=$1 ?>', $template);
    }





    /**
     * @param $template
     *
     * @return string
    */
    private function compileLoop($template): string
    {
        $template = preg_replace('/@loop(.*):/', '<?php foreach$1: ?>', $template);
        $template = preg_replace('/@endloop/', '<?php endforeach; ?>', $template);

        return $this->compileFor($template);
    }





    /**
     * @param $template
     *
     * @return string
    */
    private function compileFor($template): string
    {
        $template = preg_replace('/@for(.*):/', '<?php for$1: ?>', $template);
        return preg_replace('/@endfor/', '<?php endfor; ?>', $template);
    }





    /**
     * @param $template
     *
     * @return string
    */
    private function compileSwitch($template): string
    {
        $template = preg_replace('/@switch(.*):/', '<?php switch$1: ?>', $template);
        return preg_replace('/@endswitch/', '<?php endswitch; ?>', $template);
    }





    /**
     * @param $template
     *
     * @return string
    */
    private function compileIf($template): string
    {
        $template = preg_replace('/@if(.*):/', '<?php if$1: ?>', $template);
        return preg_replace('/@endif/', '<?php endif; ?>', $template);
    }





    /**
     * @param $template
     *
     * @return string
    */
    private function compileIncludes($template): string
    {
        return preg_replace('/{%\s*include(.*)\s*%}/i', '<?php include$1 ?>', $template);
    }






    /**
     * @return array
    */
    private function getBlocks(): array
    {
        $pattern = "/@block-(.*?):(.*?)@endblock/is";

        preg_match_all($pattern, $this->getTemplate(), $matches, PREG_SET_ORDER);

        if (empty($matches)) {
            return [];
        }

        $blocks = [];

        foreach ($matches as $item) {
            $blocks[$item[1]] = $item[2];
        }

        return $blocks;
    }
}