<?php
namespace Laventure\Component\Routing\Resource;


use Laventure\Component\Routing\Resource\Contract\Resource;
use Laventure\Component\Routing\Router;


/**
 * @WebResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource
*/
class WebResource extends Resource
{

    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        return 'web';
    }



    /**
     * @inheritDoc
    */
    protected function getRouteParams(): array
    {
         return [
            ['GET', '', 'index', []],
            ['GET', '/{id}', 'show', ['id' => '\d+']],
            ['GET', '', 'create', []],
            ['POST', '', 'store', []],
            ['GET', '/{id}/edit', 'edit', ['id' => '\d+']],
            ['PUT|PATCH', '/{id}', 'update', ['id' => '\d+']],
            ['DELETE', '/{id}', 'destroy', ['id' => '\d+']]
         ];
    }
}