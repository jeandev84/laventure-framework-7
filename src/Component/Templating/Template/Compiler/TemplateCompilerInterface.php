<?php
namespace Laventure\Component\Templating\Compiler;

use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @TemplateCompilerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Compiler
*/
interface TemplateCompilerInterface
{
       /**
        * @param TemplateInterface $template
        *
        * @return TemplateInterface
       */
       public function compileTemplate(TemplateInterface $template): TemplateInterface;
}