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
        $layout = $this->getLayout();
        $blocks = $this->getBlocks();

        $template = $this->compileYields($layout, $blocks);
        $template = $this->compileEchos($template);

        return $this->compileLoop($template);
    }





    /**
     * @param $layout
     *
     * @param array $blocks
     *
     * @return string
    */
    private function compileYields($layout, array $blocks): string
    {
        // compile yields
        foreach ($blocks as $name => $content) {
            $layout = preg_replace("/@yield-$name/is", $content, $layout);
        }

        return $layout;
    }






    /**
     * @param $template
     *
     * @return string
    */
    private function compileEchos($template): string
    {
        return preg_replace('/{{\s*(.*)\s*}}/', '<?= $1 ?>', $template);
    }




    /**
     * @param $template
     *
     * @return string
    */
    private function compileLoop($template): string
    {
        $template = preg_replace('/@loop(.*):/', '<?php foreach$1: ?>', $template);
        return preg_replace('/@endloop/', '<?php endforeach; ?>', $template);
    }





    /**
     * @return string[]
    */
    private function getPatterns(): array
    {
        return [
            '@loop((.*)\s*as\s*(.*)):' => '<?php foreach ($$1 as $$2)?>',
            '{{\s*(.*)\s*}}' => '<?= $$1 ?>'
        ];
    }





    /**
     * @param string|null $layout
     *
     * @return string
    */
    private function replacePatterns(?string $layout): string
    {
         $pattern     = join('|', array_keys($this->getPatterns()));
         $replacement = join('|', array_values($this->getPatterns()));

         return preg_replace('/'. $pattern . '/', $replacement, $layout);
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