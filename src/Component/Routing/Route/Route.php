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
class Route implements RouteInterface, \ArrayAccess
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
    protected $path = '/';




    /**
     * Route pattern
     *
     * @var string
    */
    protected $pattern = '/';





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
     * Request url
     *
     * @var string
    */
    protected $url;





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
     * @var array
    */
    protected $namedMiddlewares = [];




    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [];




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




    private const MAP = [];



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
     * @return array
     */
    public function getMatches(): array
    {
        return $this->matches;
    }





    /**
     * @return array
    */
    public function getPatterns(): array
    {
        return $this->patterns;
    }





    /**
     * @return array
    */
    public static function getPlaceholders(): array
    {
        return self::$placeholders;
    }






    /**
     * @return string
    */
    public function getUrl(): string
    {
        return $this->url;
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
        $pattern = str_replace('(', '(?:', $pattern);

        $this->patterns[$name] = [
            "#{{$name}}#"   => "(?P<$name>$pattern)",
            "#{{$name}.?}#" => "?(?P<$name>$pattern)?"
        ];

        $searched = array_keys($this->patterns[$name]);
        $replaces = array_values($this->patterns[$name]);

        $this->pattern(preg_replace($searched, $replaces, $this->pattern));


        return $this;
    }





    /**
     * @param array $patterns
     *
     * @return $this
    */
    public function wheres(array $patterns): static
    {
        foreach ($patterns as $name => $pattern) {
            $this->where($name, $pattern);
        }

        return $this;
    }





    /**
     * @param string $name
     * @return $this
     */
    public function whereNumber(string $name): self
    {
        return $this->where($name, '\d+');
    }






    /**
     * @param string $name
     * @return $this
    */
    public function whereText(string $name): self
    {
        return $this->where($name, '\w+');
    }






    /**
     * @param string $name
     * @return $this
    */
    public function whereAlphaNumeric(string $name): self
    {
        return $this->where($name, '[^a-z_\-0-9]');
    }





    /**
     * @param string $name
     * @return $this
    */
    public function whereSlug(string $name): self
    {
        return $this->where($name, '[a-z\-0-9]+');
    }




    /**
     * @param string $name
     * @return $this
    */
    public function anything(string $name): self
    {
        return $this->where($name, '.*');
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
     * @param string $uri
     *
     * @return bool
     *
     * @throws RouteException
    */
    public function matchUri(string $uri): bool
    {
         $path    = parse_url($uri, PHP_URL_PATH);
         $pattern = $this->getPattern();

         preg_match("#^$pattern$#i", $path, $matches);

         if (empty($matches)) {
              return false;
         }

         $this->params  = $this->resolveParams($matches);
         $this->matches = $matches;
         $this->url     = sprintf('%s%s', $this->domain, $uri);

         return true;
    }


    /**
     * @inheritDoc
     *
     * @throws RouteException
    */
    public function match(string $method, string $path): bool
    {
         return $this->matchMethods($method) && $this->matchUri($path);
    }





    /**
     * @inheritDoc
    */
    public function generate(array $parameters = []): string
    {
         $path = $this->getPath();

         foreach ($parameters as $name => $value) {
              if (! empty($this->patterns[$name])) {
                  $path = preg_replace(array_keys($this->patterns[$name]), [$value], $path);
              }
         }

         return $path;
    }





    /**
     * @param array $parameters
     *
     * @return string
    */
    public function url(array $parameters = []): string
    {
        return sprintf('%s%s', $this->domain, $this->generate($parameters));
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
     * @param array $matches
     *
     * @return array
    */
    private function resolveParams(array $matches): array
    {
        return array_filter($matches, function ($key) {
            return ! is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);
    }




    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset)
    {
        return property_exists($this, $offset);
    }



    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset)
    {
        if (! $this->offsetExists($offset)) {
            return false;
        }

        return $this->{$offset};
    }




    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value)
    {
        if ($this->offsetExists($offset)) {
            $this->{$offset} = $value;
        }
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->{$offset});
        }
    }
}