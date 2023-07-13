<?php
namespace Laventure\Component\Templating\Template\Layout;


use Laventure\Component\Templating\Template\Template;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @Layout
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Template\Layout
*/
class Layout extends Template implements LayoutInterface
{


    /**
     * @var Template
    */
    protected Template $template;



    /**
     * @param string $path
     *
     * @param Template $template
    */
    public function __construct(string $path, Template $template)
    {
        parent::__construct($path, $template->getParameters());
        $this->template = $template;
    }





    /**
     * @inheritDoc
    */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }






    /**
     * @param string $template
     *
     * @return string
    */
    private function compile(string $template): string
    {
        $template = $this->compileYields($template);

        return $this->compileEchos($template);
    }




    /**
     * @param string $template
     *
     * @return string
    */
    private function compileYields(string $template): string
    {
        $blocks = $this->getTemplateBlocks();

        foreach ($blocks as $name => $content) {
            $template = preg_replace("/@yield-$name/is", $content, $template);
        }

        return $template;
    }




    /**
     * @param string $template
     *
     * @return string
    */
    private function compileEchos(string $template): string
    {
        foreach ($this->parameters as $name => $value) {

            if (preg_match("~\{{\s*($name)\s*}}~is", $template, $matches)) {
                  if (isset($this->parameters[$matches[1]])) {
                      $template = preg_replace("~\{{\s*($name)\s*}}~is", "<?= $value ?>", $template);
                  }
            }

            if (is_array($value) && preg_match("/@loop\s*(.*?)\s*as\s*(.*?):(.*)@endloop/is", $template, $matches)) {

                  $key  = $matches[1];
                  $data = $matches[2];

                  # dd($matches);
                  if (isset($this->parameters[$key])) {
                      /*
                      $template = preg_replace("/@loop\s*(.*?)\s*as\s*(.*?):/is", "<?php foreach(${$key} as ${$data}): ?>", $template);
                      dd($template);
                      */
                  }
            }

        }

        return $template;
    }




    /**
     * @return array
    */
    private function getTemplateBlocks(): array
    {
        $pattern = "/@block-(.*?):(.*?)@endblock/is";

        preg_match_all($pattern, $this->template, $matches, PREG_SET_ORDER);

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