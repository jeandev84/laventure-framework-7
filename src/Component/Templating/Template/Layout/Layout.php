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
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->exists()) {
            return $this->template;
        }

        $content = parent::__toString();

        return str_replace("{{ content }}", $this->template->__toString(), $content);
    }
}