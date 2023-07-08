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
class Layout implements LayoutInterface
{


    /**
     * @var Template;
    */
    protected Template $layout;



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
         $this->layout   = new Template($path);
         $this->template = $template;
    }





    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
         return $this->layout->getPath();
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        if (! $this->layout->exists()) {
            return $this->template;
        }

        $this->layout->setTags(['{{ content }}' => $this->template]);

        return $this->layout;
    }






    /**
     * @inheritDoc
    */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }
}