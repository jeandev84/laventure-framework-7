<?php
namespace Laventure\Component\Database\ORM\Persistence\Manager;

use Laventure\Component\Database\Builder\SQL\Commands\DQL\Select;
use \Laventure\Component\Database\Builder\SQL\Commands\DQL\Query as QueryHydrate;


/**
 * @inheritdoc
*/
class Query extends QueryHydrate
{


     /**
      * @param Select $builder
      *
      * @param string|null $classname
     */
     public function __construct(Select $builder, string $classname = null)
     {
          parent::__construct($builder, $classname);
     }





     /**
      * @return mixed
     */
     public function getResult(): mixed
     {
          return parent::getResult();
     }





     /**
      * @return mixed
     */
     public function getOneOrNullResult(): mixed
     {
          return parent::getOneOrNullResult();
     }
}