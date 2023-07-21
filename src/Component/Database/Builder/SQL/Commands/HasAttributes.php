<?php
namespace Laventure\Component\Database\Builder\SQL\Commands;


/**
 * @HasAttributes
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Builder\SQL\Commands
*/
trait HasAttributes
{


      /**
       * @param array $attributes
       *
       * @param bool $pdo
       *
       * @return array
      */
      protected function resolveAttributes(array $attributes, bool $pdo = false): array
      {
            $resolved = [];

            foreach ($attributes as $column => $value) {
                 if ($pdo) {
                     $resolved[] = "$column = :$column";
                 } else {
                     $resolved[] = "$column = ". $this->resolveAttributeValue($value);
                 }
            }

            return $resolved;
      }




      /**
       * @param $value
       *
       * @return string
      */
      protected function resolveAttributeValue($value): string
      {
           return "'$value'";
      }
}