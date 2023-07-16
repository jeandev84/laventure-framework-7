<?php
namespace Laventure\Component\Filesystem\File\Collection;


use CallbackFilterIterator;
use Closure;
use Laventure\Component\Filesystem\File\File;

/**
 * @FileCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\File\Collection
*/
class FileCollection
{

      /**
       * @var File[]
      */
      protected array $files = [];





      /**
       * @param File[] $files
      */
      public function __construct(array $files)
      {
          $this->addFiles($files);
      }




      /**
       * @param File $file
       *
       * @return $this
      */
      public function addFile(File $file): static
      {
          $this->files[] = $file;

          return $this;
      }





      /**
       * @param File[] $files
       *
       * @return $this
      */
      public function addFiles(array $files): static
      {
          foreach ($files as $file) {
              $this->addFile($file);
          }

          return $this;
      }
}