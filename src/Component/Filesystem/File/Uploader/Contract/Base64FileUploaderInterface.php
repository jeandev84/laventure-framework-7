<?php
namespace Laventure\Component\Filesystem\File\Uploader\Contract;


use Laventure\Component\Filesystem\File\FileBase64;

/**
 * @Base64FileUploaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\File\Uploader\Contract
*/
interface Base64FileUploaderInterface
{
      /**
       * @param string $target
       *
       * @param FileBase64 $file
       *
       * @return mixed
      */
      public function uploadBase64(string $target, FileBase64 $file): mixed;
}