<?php
namespace Laventure\Component\Database\Schema\Blueprint\Drivers;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;
use Laventure\Component\Database\Schema\Blueprint\Column\Drivers\MysqlColumn;


/**
 * @inheritdoc
*/
class MysqlBlueprint extends Blueprint
{

    /**
     * @inheritDoc
    */
    public function createTable(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function updateTable(): bool
    {
        // TODO: Implement updateTable() method.
    }



    /**
     * @inheritDoc
    */
    public function dropTable(): bool
    {
        // TODO: Implement dropTable() method.
    }



    /**
     * @inheritDoc
    */
    public function dropTableIfExists(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function increments(string $name): Column
    {
        return $this->add($this->createColumn($name, 'BIGINT AUTO_INCREMENT')->primaryKey());
    }





    /**
     * @inheritDoc
    */
    public function integer(string $name, int $length = 11): Column
    {
         return $this->add($this->createColumn($name, "INT($length)"));
    }






    /**
     * @inheritDoc
    */
    public function smallInteger(string $name): Column
    {
         return $this->add($this->createColumn($name, 'SMALLINT'));
    }






    /**
     * @inheritDoc
    */
    public function bigInteger(string $name): Column
    {
         return $this->add($this->createColumn($name, 'BIGINT'));
    }






    /**
     * @inheritDoc
    */
    public function datetime(string $name): Column
    {
        return $this->addColumn($name, 'DATETIME');
    }






    /**
     * @inheritDoc
    */
    public function truncateTable(): bool
    {

    }







    /**
     * @inheritDoc
    */
    public function truncateTableCascade(): bool
    {

    }





    /**
     * @inheritDoc
    */
    public function describeTable(): mixed
    {
        // TODO: Implement describeTable() method.
    }






    /**
     * @param string $name
     *
     * @param string $type
     *
     * @param string $constraints
     *
     * @return MysqlColumn
    */
    public function createColumn(string $name, string $type, string $constraints = ''): MysqlColumn
    {
          return new MysqlColumn($name, $type, $constraints);
    }
}