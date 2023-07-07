<?php
namespace Laventure\Component\Routing\Generator;


use Laventure\Component\Routing\Router;

/**
 * @UrlGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Generator
*/
class UrlGenerator implements UrlGeneratorInterface
{


    /**
     * @param Router $router
     *
     * @param array $queries
    */
    public function __construct(protected Router $router, protected array $queries = [])
    {
    }




    /**
     * @inheritDoc
    */
    public function generate(string $name, array $parameters = [], array $queries = [], string $fragment = null)
    {
         $path = $this->generateUri($name, $parameters, $queries, $fragment);

         return sprintf('%s%s', rtrim($this->router->getDomain(), '/'), $path);
    }





    /**
     * @inheritDoc
    */
    public function generateUri(string $name, array $parameters = [], array $queries = [], string $fragment = null): string
    {
        if (! $path = $this->router->generate($name, $parameters)) {
            return sprintf('%s%s#%s', $name, $this->buildQueriesParams($queries), $fragment);
        }

        return sprintf('%s%s#%s', $path, $this->buildQueriesParams($queries), $fragment);
    }





    /**
     * @param array $queries
     *
     * @return string
    */
    private function buildQueriesParams(array $queries): string
    {
        $queries = array_merge($this->queries, $queries);

        return http_build_query($queries);
    }

}