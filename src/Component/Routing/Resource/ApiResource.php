<?php
namespace Laventure\Component\Routing\Resource;


use Laventure\Component\Routing\Resource\Contract\Resource;
use Laventure\Component\Routing\Router;

/**
 * @ApiResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource
*/
class ApiResource extends Resource
{


    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        return 'api';
    }




    /**
     * @inheritDoc
    */
    protected function getRouteParams(): array
    {
        return [
            ['GET', '', 'index', []],
            ['GET', '/{id}', 'show', ['id' => '\d+']],
            ['POST', '', 'store', []],
            ['PUT|PATCH', '/{id}', 'update', ['id' => '\d+']],
            ['DELETE', '/{id}', 'destroy', ['id' => '\d+']]
        ];
    }
}