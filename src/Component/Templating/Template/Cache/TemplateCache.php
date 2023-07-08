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
        $this->cacheDir = rtrim($cacheDir, DIRECTORY_SEPARATOR);
    }



    /**
     * @inheritDoc
     *
     * @throws TemplateException
    */
    public function cacheTemplate(string $key, TemplateInterface $template): int|bool
    {
        try {

            $path = $this->cachePath($key);

            $dirname = dirname($path);

            if (! is_dir($dirname)) {
                mkdir($dirname, 0777, true);
            }

            if (! touch($path)) {
                return false;
            }

            return file_put_contents($path, $template);

        } catch (Exception $e) {

             throw new TemplateException($e->getMessage(), 500);
        }
    }






    /**
     * @inheritDoc
    */
    public function exists(string $key): bool
    {
        return file_exists($this->cachePath($key));
    }





    /**
     * @inheritDoc
    */
    public function getTemplate(string $key): string
    {
         if (! $this->exists($key)) {
              throw new TemplateException("Could not found template cache : $key");
         }

         return file_get_contents($this->cachePath($key));
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
}