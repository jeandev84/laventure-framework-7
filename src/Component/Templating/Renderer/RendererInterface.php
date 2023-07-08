<?php
namespace Laventure\Component\Templating\Renderer;


/**
 * @RendererInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Renderer
*/
interface RendererInterface
{
    /**
     * @param string $path
     *
     * @param array $data
     *
     * @return mixed
    */
    public function render(string $path, array $data = []): mixed;
}