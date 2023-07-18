<?php
namespace Laventure\Component\Filesystem;


use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\FileBase64;
use Laventure\Component\Filesystem\File\FileInfo;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\File\Stream;



/**
 * @Filesystem
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem
*/
class Filesystem
{

      /**
       * @var FileLocator
      */
      protected FileLocator $locator;




      /**
       * @param string $resource
      */
      public function __construct(string $resource = '')
      {
           $this->locator = new FileLocator($resource);
      }






      /**
       * @param string $resource
       *
       * @return $this
      */
      public function resource(string $resource): static
      {
          $this->locator->resource($resource);

          return $this;
      }





      /**
       * @param $path
       *
       * @return string
      */
      public function locate($path): string
      {
          return $this->locator->locate($path);
      }





      /**
       * @param $path
       *
       * @return mixed
      */
      public function load($path): mixed
      {
          return $this->file($path)->load();
      }





     /**
      * @param string $path
      *
      * @return FileInfo
     */
     public function info(string $path): FileInfo
     {
        return new FileInfo($this->locate($path));
     }





      /**
       * @param string $path
       *
       * @return File
      */
      public function file(string $path): File
      {
          return new File($this->locate($path));
      }








      /**
       * @param string $path
       *
       * @param string $accessMode
       *
       * @return Stream
      */
      public function stream(string $path, string $accessMode = 'r'): Stream
      {
           return new Stream($path, $accessMode);
      }






      /**
       * @param $path
       *
       * @return bool
      */
      public function exists($path): bool
      {
          return $this->file($path)->exists();
      }







      /**
       * @param string $from
       *
       * @param string $destination
       *
       * @param null $context
       *
       * @return bool
      */
      public function copy(string $from, string $destination, $context = null): bool
      {
          return $this->file($from)->copyTo($this->locate($destination), $context);
      }








      /**
       * @param string $path
       *
       * @return bool
      */
      public function remove(string $path): bool
      {
          return $this->file($path)->remove();
      }






      /**
       * @param $path
       *
       * @param string $content
       *
       * @param bool $append
       *
       * @return false|int
      */
      public function write($path, string $content, bool $append = false): false|int
      {
           return $this->file($path)->write($content, $append);
      }







      /**
       * @param $path
       *
       * @return string
      */
      public function read($path): string
      {
          return $this->file($path)->read();
      }







      /**
       * @param string $path
       *
       * @return bool
      */
      public function mkdir(string $path): bool
      {
           if(! $this->info($path)->isDir()) {
                return mkdir($this->locate($path), 0777, true);
           }

           return true;
      }





      /**
       * @param string $path
       *
       * @return array|false
      */
      public function scan(string $path): bool|array
      {
           if (! $this->info($path)->isDir()) {
                return false;
           }

           return scandir($this->locate($path));
      }






      /**
       * @param string $path
       *
       * @return bool
      */
      public function make(string $path): bool
      {
           return $this->file($path)->make();
      }





      /**
       * @param string $from
       *
       * @param string $to
       *
       * @return bool
      */
      public function upload(string $from, string $to): bool
      {
           return $this->file($from)->moveTo($this->locate($to));
      }






      /**
       * @param string $target
       *
       * @param FileBase64 $file
       *
       * @return false|int
      */
      public function uploadBase64(string $target, FileBase64 $file): bool|int
      {
           return $this->write($target, $file->getContent());
      }
}