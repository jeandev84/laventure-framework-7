<?php
namespace Laventure\Component\Database\Migration;

use Laventure\Component\Database\Migration\Contract\MigrationInterface;
use ReflectionClass;


/**
 * @Migration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Migration
*/
abstract class Migration implements MigrationInterface
{


    /**
     * @var string
    */
    private string $name;




    /**
     * @var string
    */
    private string $path;





    /**
     * @param string $name
     *
     * @return $this
    */
    public function version(string $name): static
    {
        $this->name = $name;

        return $this;
    }






    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }






    /**
     * Returns name or version of migration
     *
     * @return string
    */
    public function getName(): string
    {
          return $this->name ?? $this->reflection()->getShortName();
    }







    /**
     * Returns migration path
     *
     * @return string
    */
    public function getPath(): string
    {
        return $this->path ?? $this->reflection()->getFileName();
    }






    /**
     * @return ReflectionClass
    */
    private function reflection(): ReflectionClass
    {
        return new ReflectionClass(get_called_class());
    }
}