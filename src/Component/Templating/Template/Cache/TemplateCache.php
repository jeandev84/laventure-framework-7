<?php
namespace Laventure\Component\Templating\Template\Cache;

use Exception;
use Laventure\Component\Templating\Template\TemplateException;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * @TemplateCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Template\Cache
*/
class TemplateCache implements TemplateCacheInterface
{


    /**
     * @var string
    */
    protected string $cacheDir;




    /**
     * @param string $cacheDir
    */
    public function __construct(string $cacheDir)
    {
        $this->cacheDir($cacheDir);
    }




    /**
     * @param string $cacheDir
     *
     * @return $this
    */
    public function cacheDir(string $cacheDir): static
    {
        $this->cacheDir = rtrim($cacheDir, DIRECTORY_SEPARATOR);

        return $this;
    }





    /**
     * @param string $key
     *
     * @return string
    */
    public function cachePath(string $key): string
    {
         return join(DIRECTORY_SEPARATOR, [$this->cacheDir, md5($key) .'.php']);
    }




    /**
     * @inheritDoc
    */
    public function cache(string $key, TemplateInterface|string $template): string
    {
        $path = $this->cachePath($key);

        try {

            $dirname = dirname($path);

            if (! is_dir($dirname)) {
                mkdir($dirname, 0777, true);
            }

            touch($path);

            file_put_contents($path, $template);

        } catch (Exception $e) {

            throw new TemplateCacheException($e->getMessage(), 500);
        }

        return file_get_contents($path);
    }
}