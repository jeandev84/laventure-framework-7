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
     * @var TemplateInterface
    */
    protected TemplateInterface $template;




    /**
     * @param string $path
     *
     * @param TemplateInterface $template
    */
    public function __construct(string $path, TemplateInterface $template)
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
}