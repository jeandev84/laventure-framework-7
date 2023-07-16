<?php
namespace Laventure\Component\Filesystem;


use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\FileBase64;
use Laventure\Component\Filesystem\File\FileInfo;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\File\Reader\FileReader;
use Laventure\Component\Filesystem\File\Stream;
use Laventure\Component\Filesystem\File\Uploader\FileUploader;
use Laventure\Component\Filesystem\File\Writer\FileWriter;



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
       * @var FileWriter
      */
      protected FileWriter $writer;




      /**
       * @var FileReader
      */
      protected FileReader $reader;



      /**
       * @var FileUploader
      */
      protected FileUploader $uploader;




      /**
       * @param string $resource
      */
      public function __construct(string $resource = '')
      {
           $this->locator  = new FileLocator($resource);
           $this->writer   = new FileWriter();
           $this->reader   = new FileReader();
           $this->uploader = new FileUploader();
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
          return $this->uploader->copy($this->locate($from), $this->locate($destination), $context);
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
       * @param int $flags
       *
       * @param null $context
       *
       * @return false|int
      */
      public function write($path, string $content, int $flags = 0, $context = null): false|int
      {
           if (! $this->exists($path)) {
                $this->make($path);
           }

           return $this->writer->write($this->locate($path), $content, $flags, $context);
      }






      /**
       * @param $path
       *
       * @return string
      */
      public function read($path): string
      {
          return $this->reader->read($this->locate($path));
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
       * @return bool
      */
      public function make(string $path): bool
      {
          return $this->file($path)->touch();
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
           return $this->uploader->upload($this->locate($from), $this->locate($to));
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