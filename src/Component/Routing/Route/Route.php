<?php
namespace Laventure\Component\Routing\Route;


/**
 * @Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
class Route implements RouteInterface
{

    /**
     * Route domain
     *
     * @var  string
    */
    protected $domain;





    /**
     * Route methods
     *
     * @var array
    */
    protected $methods = [];




    /**
     * Route path
     *
     * @var string
    */
    protected $path;




    /**
     * Route pattern
     *
     * @var string
    */
    protected $pattern;





    /**
     * Route handler.
     *
     * @var mixed
    */
    protected $action;




    /**
     * Route name
     *
     * @var string
    */
    protected $name;




    /**
     * Route params
     *
     * @var array
    */
    protected $params = [];




    /**
     * Route middlewares
     *
     * @var array
    */
    protected $middlewares = [];



    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [];



    /**
     * Route placeholders
     *
     * @var array
    */
    protected $placeholders = [];




    /**
     * Route options
     *
     * @var array
    */
    protected $options = [];





    /**
     * Matches request params
     *
     * @var array
    */
    protected $matches = [];





    /**
     * @var array
    */
    protected array $prefixes = [
        'path'        => '',
        'namespace'   => '',
        'name'        => ''
    ];




    /**
     * @param array $prefixes
     *
     * @param array $middlewares
    */
    public function __construct(array $prefixes = [], array $middlewares = [])
    {
         $this->prefixes($prefixes);
    }





    /**
     * @inheritDoc
    */
    public function getDomain(): string
    {
        return $this->domain;
    }




    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return $this->methods;
    }




    /**
     * @param string $separator
     *
     * @return string
     */
    public function getMethodsAsString(string $separator = '|'): string
    {
        return join($separator, $this->methods);
    }





    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }





    /**
     * @inheritDoc
    */
    public function getAction(): mixed
    {
        return $this->action;
    }





    /**
     * @inheritDoc
    */
    public function getPattern(): string
    {
        return $this->pattern;
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return $this->params;
    }




    /**
     * @inheritDoc
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }





    /**
     * @return array
    */
    public function getPrefixes(): array
    {
        return $this->prefixes;
    }




    /**
     * @return mixed
    */
    public function getNamespace(): string
    {
        if(! $namespace = $this->prefix('namespace', '')) {
            throw new \InvalidArgumentException("Unavailable controller namespace.");
        }

        return trim($namespace, '\\');
    }







    /**
     * @param array $prefixes
     *
     * @return $this
     */
    public function prefixes(array $prefixes): static
    {
        if (! empty($prefixes['name'])) {
            $this->name($prefixes['name']);
        }

        $this->prefixes = array_merge($this->prefixes, $prefixes);

        return $this;
    }





    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed|null
     */
    public function prefix(string $name, $default = null): mixed
    {
        return $this->prefixes[$name] ?? $default;
    }





    /**
     * @param string $domain
     *
     * @return $this
     */
    public function domain(string $domain): static
    {
        $this->domain = rtrim($domain, '\\/');

        return $this;
    }




    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function namespace(string $namespace): static
    {
        return $this->prefixes(compact('namespace'));
    }






    /**
     * @param array|string $methods
     *
     * @return $this
     */
    public function methods(array|string $methods): static
    {
        $this->methods = $this->resolveMethods($methods);

        return $this;
    }





    /**
     * @param string $path
     * @return $this
     */
    public function path(string $path): static
    {
        $this->path = $this->resolvePath($path);

        $this->pattern($this->path);

        return $this;
    }





    /**
     * @param string $pattern
     *
     * @return $this
     */
    public function pattern(string $pattern): static
    {
        $this->pattern = $pattern;

        return $this;
    }






    /**
     * @param mixed $action
     *
     * @return $this
    */
    public function action(mixed $action): static
    {
        if (is_string($action)) {
            $action = $this->resolveActionFromString($action);
        }

        if (is_array($action)) {
            [$controller, $action] = $this->resolveActionFromArray($action);
            $action = compact('controller', 'action');
        }

        $this->action = $action;

        return $this;
    }




    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name .= $name;

        return $this;
    }




    /**
     * Set route pattern
     *
     * @param string $name
     *
     * @param string $pattern
     *
     * @return $this
    */
    public function where(string $name, string $pattern): static
    {
        if (! $this->pattern) {
            return $this;
        }

        $pattern = $this->resolvePattern($pattern);

        $placeholders = [
            //"searched" => ["#{{$name}}#", "#{{$name}.?}#"],
            "#{{$name}}#"   => "(?P<$name>$pattern)",
            "#{{$name}.?}#" => "?(?P<$name>$pattern)?"
        ];

        $searched = array_keys($placeholders);
        $replaces = array_values($placeholders);

        $this->pattern(preg_replace($searched, $replaces, $this->pattern));

        $this->placeholders[$name] = $placeholders;
        $this->patterns[$name] = $pattern;

        return $this;
    }





    /**
     * @param string $method
     *
     * @return bool
    */
    public function matchMethods(string $method): bool
    {
        return in_array($method, $this->methods);
    }






    /**
     * @param string $path
     *
     * @return bool
    */
    public function matchPath(string $path): bool
    {
         return true;
    }




    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): bool
    {
         return $this->matchMethods($method) && $this->matchPath($path);
    }





    /**
     * @inheritDoc
    */
    public function generateURI(array $parameters = []): string
    {
         $path = $this->getPath();

         foreach ($parameters as $name => $value) {
              if (! empty($this->placeholders[$name])) {
                  $path = preg_replace(array_keys($this->placeholders[$name]), [$value], $path);
              }
         }

         return $path;
    }





    /**
     * @return bool
    */
    public function callable(): bool
    {
        return is_callable($this->action);
    }




    /**
     * @inheritDoc
    */
    public function hasName(): bool
    {
        return ! empty($this->name);
    }





    /**
     * @return bool
    */
    public function hasController(): bool
    {
        if (! is_array($this->action)) {
            return false;
        }

        return ! empty($this->action['controller']);
    }





    /**
     * @param string $path
     *
     * @return string
    */
    private function resolvePath(string $path): string
    {
        $path = (! $path ? '/' : '/'. trim($path, '\\/'));

        if ($prefix = $this->prefix('path', '')) {
            $path   = sprintf('%s/%s', $prefix, ltrim($path, '/'));
        }

        return $path;
    }





    /**
     * @param array|string $methods
     *
     * @return array
    */
    private function resolveMethods(array|string $methods): array
    {
        if (is_string($methods)) {
            $methods = explode('|', $methods);
        }

        return $methods;
    }





    /**
     * @param array $action
     *
     * @return array
    */
    private function resolveActionFromArray(array $action): array
    {
        if (empty($action[0])) {
            throw new \InvalidArgumentException("Unavailable controller name.");
        }

        return [$action[0], $action[1] ?? '__invoke'];
    }





    /**
     * @param string $action
     *
     * @return string|array
    */
    private function resolveActionFromString(string $action): string|array
    {
        if (stripos($action, '@') !== false) {
            [$controller, $method] = explode('@', $action, 2);
            $controller = sprintf('%s\\%s', $this->getNamespace(), $controller);
            return [$controller, $method];
        }

        return [$action];
    }



    /**
     * @param string $pattern
     * @return string
    */
    private function resolvePattern(string $pattern): string
    {
        return str_replace('(', '(?:', $pattern);
    }
}