<?php
namespace Laventure\Component\Routing\Resource\Contract;


use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router;


/**
 * @Resource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource\Contract
*/
abstract class Resource
{

    /**
     * @var string
     */
    protected $name;




    /**
     * @var string
    */
    protected $controller;




    /**
     * @param string $name
     * @param string $controller
    */
    public function __construct(string $name, string $controller)
    {
        $this->name       = strtolower($name);
        $this->controller = $controller;
    }






    /**
     * @param string $suffix
     *
     * @return string
    */
    protected function path(string $suffix = ''): string
    {
        return "/{$this->name}$suffix";
    }






    /**
     * @param string $action
     *
     * @return array|string
    */
    protected function action(string $action): array|string
    {
        if (class_exists($this->controller)) {
            return [$this->controller, $action];
        }

        return "$this->controller@$action";
    }





    /**
     * @param string $name
     * @return string
     */
    protected function name(string $name): string
    {
        return "$this->name.$name";
    }





    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }





    public function getTemplates(): array
    {

    }





    /**
     * @param Router $router
     *
     * @return $this
    */
    abstract public function map(Router $router): static;






    /**
     * @return string
    */
    abstract public function getType(): string;
}