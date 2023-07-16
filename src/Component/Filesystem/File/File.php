<?php
namespace Laventure\Component\Filesystem\File;



use Laventure\Component\Filesystem\Reader\FileReader;
use Laventure\Component\Filesystem\Writer\FileWriter;
use Laventure\Component\Uploader\FileUploader;

/**
 * @File
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\File
*/
class File extends FileInfo
{

       /**
        * @var string
       */
       protected string $path;




      /**
       * @param string $path
      */
      public function __construct(string $path)
      {
           parent::__construct($path);
           $this->path = $path;
      }




      /**
       * @return string
      */
      public function getName(): string
      {
          return $this->getFilename();
      }





     /**
      * @return bool
     */
     public function exists(): bool
     {
         return file_exists($this->path);
     }





     /**
      * @return bool
     */
     public function touch(): bool
     {
         $dirname = $this->getDirname();

         if (! is_dir($dirname)) {
             mkdir($dirname, 0777, true);
         }

         return touch($this->path);
     }







     /**
      * @return bool
     */
     public function remove(): bool
     {
         return unlink($this->path);
     }





     /**
      * @return array|false
     */
     public function asArray(): bool|array
     {
         return file($this->getRealPath(),  FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
     }
}