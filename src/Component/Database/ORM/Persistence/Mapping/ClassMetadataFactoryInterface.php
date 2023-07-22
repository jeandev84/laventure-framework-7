<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;


/**
 * @ClassMetadataFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping
*/
interface ClassMetadataFactoryInterface
{

     /**
      * Returns all metadata
      *
      * @return array
     */
     public function getAllMetadata(): array;




     /**
      * @param string $classname
      *
      * @return array
     */
     public function getMetadataForGivenClass(string $classname): array;







     /**
      * @param string $classname
      *
      * @return bool
     */
     public function hasMetadataForGivenClass(string $classname): bool;






     /**
      * @param string $classname
      *
      * @param string $class
      *
      * @return mixed
     */
     public function setClassMetadata(string $classname, string $class): mixed;






     /**
      * @param string $classname
      * @return bool
     */
     public function isTransient(string $classname): bool;
}