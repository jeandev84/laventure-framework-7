<?php
namespace Laventure\Component\Templating\Template\Layout;

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
interface LayoutInterface extends TemplateInterface
{

    /**
     * @return TemplateInterface
    */
    public function getTemplate(): TemplateInterface;
}