<?php
namespace Laventure\Component\Filesystem\File;

/**
 * @FileBase64
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\File
*/
class FileBase64
{

    /**
     * @var string
    */
    protected string $encodedString;



    /**
     * @var string
    */
    protected string $extension;



    /**
     * @param string $encodedString
     *
     * @param string $extension
    */
    public function __construct(string $encodedString, string $extension = '')
    {
        $this->encodedString = $encodedString;
        $this->extension     = $extension;
    }





    /**
     * @return bool
    */
    public function valid(): bool
    {
         return preg_match('/^(?:[data]{4}:(text|image|application)\/[a-z]*)/', $this->encodedString);
    }






    /**
     * @param bool $strict
     *
     * @return bool|string
    */
    public function decodeEncodedString(bool $strict = false): bool|string
    {
        return base64_decode($this->encodedString, $strict);
    }






    /**
     * @return string
    */
    public function getEncodedString(): string
    {
         return $this->encodedString;
    }





    /**
     * @return string
    */
    public function getContent(): string
    {
         $content = explode(';base64,', $this->encodedString, 2)[1] ?? '';

         if (! $content) {
             return '';
         };

         return base64_decode($content);
    }






    /**
     * @return string
    */
    public function getExtension(): string
    {
         if ($this->extension) {
              return $this->extension;
         }

         return explode('/', $this->getMimeType(), 2)[1] ?? '';
    }






    /**
     * @return int
    */
    public function getSize(): int
    {
        return @getimagesize($this->encodedString);
    }






    /**
     * @return string
    */
    public function getMimeType(): string
    {
        return @mime_content_type($this->encodedString);
    }





    /**
     * @param array $allowedFileTypes
     *
     * @return bool
    */
    public function allowedTypes(array $allowedFileTypes): bool
    {
         return in_array($this->getMimeType(), $allowedFileTypes);
    }
}