<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;

class ClassMetadata
{


      /**
       * @var \ReflectionClass
      */
      protected \ReflectionClass $reflection;


      /**
       * @param string $class
       *
       * @throws \ReflectionException
      */
      public function __construct(string $class)
      {
          $this->reflection  = new \ReflectionClass($class);
      }




     /**
      * @return \ReflectionClass
     */
     public function getReflection(): \ReflectionClass
     {
        return $this->reflection;
     }
}