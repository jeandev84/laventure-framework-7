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
            [
                'methods'  => 'GET',
                'path'     => '',
                'action'   => 'index',
                'patterns' => []
            ],
            [
                'methods'  => 'GET',
                'path'     => '/{id}',
                'action'   => 'show',
                'patterns' => ['id' => '\d+']
            ],
            [
                'methods'  => 'POST',
                'path'     => '',
                'action'   => 'store',
                'patterns' => []
            ],
            [
                'methods'  => 'PUT|PATCH',
                'path'     => '/{id}',
                'action'   => 'update',
                'patterns' => ['id' => '\d+']
            ],
            [
                'methods'  => 'DELETE',
                'path'     => '/{id}',
                'action'   => 'destroy',
                'patterns' => ['id' => '\d+']
            ]
        ];
    }
}