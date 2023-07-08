<?php
namespace Laventure\Component\Routing\Route;


use Closure;

/**
 * @Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
class Route implements RouteInterface,\ArrayAccess
{

    /**
     * Route domain
     *
     * @var  string
    */
    protected string $domain;




    /**
     * Route path
     *
     * @var string
    */
    protected string $path = '/';




    /**
     * Route pattern
     *
     * @var string
    */
    protected string $pattern = '/';





    /**
     * Route action.
     *
     * @var mixed
    */
    protected mixed $action;




    /**
     * Route name
     *
     * @var string
    */
    protected string $name = '';





    /**
     * Route locale
     *
     * @var string
    */
    protected string $locale = '';




    /**
     * Route methods
     *
     * @var array
    */
    protected array $methods = [];





    /**
     * Route params
     *
     * @var array
    */
    protected array $params = [];




    /**
     * Route middlewares
     *
     * @var array
    */
    protected array $middlewares = [];




    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [];





    /**
     * Matches request params
     *
     * @var array
    */
    protected $matches = [];



    /**
     * @var string[]
    */
    protected $prefixes = [
        'path'        => '',
        'namespace'   => '',
        'name'        => ''
    ];




    /**
     * Route options
     *
     * @var array
    */
    protected $options = [];




    /**
     * @param string $domain
     *
     * @param array $prefixes
     *
     * @param array $middlewareStack
    */
    public function __construct(string $domain, array $prefixes = [], array $middlewareStack = [])
    {
         $this->domain($domain);
         $this->prefixes($prefixes);
         $this->middlewareStack($middlewareStack);
    }





    /**
     * @param array $prefixes
     *
     * @return $this
    */
    public function prefixes(array $prefixes): static
    {
        $this->prefixes = array_merge($this->prefixes, $prefixes);

        return $this;
    }




    /**
     * @param string $locale
     *
     * @return $this
    */
    public function locale(string $locale): static
    {
         $this->locale = $locale;

         return $this;
    }





    /**
     * @param array $middlewareStack
     *
     * @return $this
    */
    public function middlewareStack(array $middlewareStack): static
    {
        return $this->options(compact('middlewareStack'));
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
        $this->domain = rtrim($domain, '/');

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
        $this->action = $this->resolveAction($action);

        return $this;
    }







    /**
     * @param callable $action
     *
     * @return $this
    */
    public function callback(callable $action): static
    {
        $this->action = $action;

        return $this;
    }




    /**
     * @param string|array $action
     *
     * @return $this
    */
    public function controller(string|array $action): static
    {
         return $this->action($action);
    }


    /**
     * @param mixed $action
     *
     * @return mixed
    */
    private function resolveAction(mixed $action): mixed
    {
        if (is_string($action)) {
            $action = $this->resolveActionFromString($action);
        }

        if (is_array($action)) {
            return $this->resolveActionFromArray($action);
        }

        return $action;
    }





    /**
     * @param string|null $name
     *
     * @return $this
    */
    public function name(?string $name): static
    {
        $prefix = $this->prefix('name', '');

        $this->name = sprintf('%s%s', $prefix, $name);

        return $this;
    }






    /**
     * @param string|array $middlewares
     *
     * @return $this
    */
    public function middleware(string|array $middlewares): static
    {
         $middlewares = $this->resolveMiddlewares((array)$middlewares);

         $this->middlewares = array_merge($this->middlewares, $middlewares);

         return $this;
    }




    /**
     * @param string $name
     *
     * @return $this
    */
    public function only(string $name): static
    {
         $this->middlewares = [];

         return $this->middleware($name);
    }





    /**
     * @param array $options
     *
     * @return $this
    */
    public function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }




    /**
     * @param string $name
     *
     * @param $default
     *
     * @return mixed|null
    */
    public function option(string $name, $default = null): mixed
    {
        return $this->options[$name] ?? $default;
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
        $pattern  = str_replace('(', '(?:', $pattern);
        $patterns = ["#{{$name}}#" => "(?P<$name>$pattern)", "#{{$name}.?}#" => "?(?P<$name>$pattern)?"];
        $searched = array_keys($patterns);
        $replaces = array_values($patterns);

        $this->pattern(preg_replace($searched, $replaces, $this->pattern));

        $this->patterns[$name] = $patterns;

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
    public function number(string $name): self
    {
        return $this->where($name, '\d+');
    }





    /**
     * @param string $name
     * @return $this
    */
    public function text(string $name): self
    {
        return $this->where($name, '\w+');
    }






    /**
     * @param string $name
     * @return $this
    */
    public function alphaNumeric(string $name): self
    {
        return $this->where($name, '[^a-z_\-0-9]');
    }





    /**
     * @param string $name
     * @return $this
    */
    public function slug(string $name): self
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
     * @inheritdoc
    */
    public function matchMethod(string $requestMethod): bool
    {
       if(! in_array($requestMethod, $this->methods)) {
           return (function() {
               throw new RouteException("Route allowed methods : {$this->getMethod(',')}");
           })();
       }

       return true;
    }







    /**
     * @inheritdoc
    */
    public function matchPath(string $requestPath): bool
    {
         $requestUrl = $this->url($requestPath);
         $path       = $this->url(parse_url($requestPath, PHP_URL_PATH));
         $pattern    = $this->url(sprintf('%s%s', $this->locale, $this->getPattern()));

         preg_match("#^$pattern$#i", $path, $matches);

         if (empty($matches)) {
              return false;
         }

         $this->params  = $this->resolveParams($matches);
         $this->matches = $matches;
         $this->options(compact('requestPath', 'requestUrl'));

         return true;
    }





    /**
     * Determine if route match current request
    */
    public function match(string $method, string $path): bool
    {
        return $this->matchPath($path) && $this->matchMethod($method);
    }






    /**
     * @inheritDoc
    */
    public function generateUri(array $parameters = []): string
    {
         $path = $this->getPath();

         foreach ($parameters as $name => $value) {
              if (! empty($this->patterns[$name])) {
                  $path = preg_replace(array_keys($this->patterns[$name]), [$value, $value], $path);
              }
         }

         return $path;
    }





    /**
     * @param array $parameters
     *
     * @return string
    */
    public function generateUrl(array $parameters = []): string
    {
        return $this->url($this->generateUri($parameters));
    }






    /**
     * @param string $path
     *
     * @return string
    */
    public function url(string $path): string
    {
        return sprintf('%s%s', $this->domain, $path);
    }





    /**
     * @return bool
    */
    public function callable(): bool
    {
        return is_callable($this->action);
    }





    /**
     * @return mixed
    */
    public function callAction(): mixed
    {
         if (! $this->callable()) {
              return false;
         }

         return call_user_func_array($this->action, array_values($this->params));
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
    public function getMethod(string $separator = '|'): string
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
     * @return string|null
    */
    public function getController(): ?string
    {
         return $this->option('controller');
    }


    



    /**
     * @return string
    */
    public function getActionName(): string
    {
        if ($this->action instanceof Closure) {
             return 'Closure';
        }

        return $this->option('action', '');
    }
    




    /**
     * @return mixed
    */
    public function getNamespace(): string
    {
        if(! $namespace = $this->prefix('namespace')) {
            throw new RouteParameterException("Unavailable controller namespace.", 409);
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
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->option('requestUrl', '');
    }




    /**
     * @return array
    */
    public function getMiddlewareStack(): array
    {
        return $this->option('middlewareStack', []);
    }






    /**
     * Determine if the given name exist in options
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasOption(string $name): bool
    {
        return isset($this->options[$name]);
    }





    /**
     * Determine if controller defined.
     *
     * @return bool
    */
    public function hasController(): bool
    {
         return $this->hasOption('controller');
    }





    /**
     * @param string $path
     *
     * @return string
    */
    private function resolvePath(string $path): string
    {
        if ($prefix = $this->prefix('path', '')) {
            $path = trim($prefix, '/') . '/'. ltrim($path, '/');
        }

        return sprintf('/%s', trim($path, '/'));
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

        return (array)$methods;
    }





    /**
     * @param array $action
     *
     * @return array
    */
    private function resolveActionFromArray(array $action): array
    {
        if (empty($action[0])) {
            throw new \InvalidArgumentException("Controller name is required parameter.");
        }

        $controller = $action[0];
        $action     = (string)($action[1] ?? '__invoke');

        $this->options(compact('controller', 'action'));

        return [$controller, $action];
    }





    /**
     * @param string $action
     *
     * @return string|array
    */
    private function resolveActionFromString(string $action): string|array
    {
        if (stripos($action, '@') !== false) {
            $action     = explode('@', $action, 2);
            $controller = sprintf('%s\\%s', $this->getNamespace(), $action[0]);
            return [$controller, $action[1]];
        }

        if (class_exists($action)) {
            return [$action];
        }

        return $action;
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
     * @param array $middlewares
     *
     * @return array
    */
    private function resolveMiddlewares(array $middlewares): array
    {
        return array_map(function ($middleware) {
            $middlewareStack = $this->getMiddlewareStack();
            $named = array_key_exists($middleware, $middlewareStack);
            return $named ? $middlewareStack[$middleware] : $middleware;
        }, $middlewares);
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