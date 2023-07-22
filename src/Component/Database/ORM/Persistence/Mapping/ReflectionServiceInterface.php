<?php
namespace Laventure\Component\Database\ORM\Persistence\Mapping;


/**
 * @ReflectionService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Persistence\Mapping
*/
interface ReflectionServiceInterface
{

     /**
      * @param string $classname
      *
      * @return mixed
     */
     public function getParentClass(string $classname): mixed;






     /**
      * @param string $classname
      *
      * @return mixed
     */
     public function getClassShortName(string $classname): mixed;







     /**
      * @param string $classname
      *
      * @return mixed
     */
     public function getClassNamespace(string $classname): mixed;









     /**
      * @param string $classname
      *
      * @param string $method
      *
      * @return bool
     */
     public function hasPublicMethod(string $classname, string $method): bool;
}