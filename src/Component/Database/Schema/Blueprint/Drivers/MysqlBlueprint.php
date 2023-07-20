<?php
namespace Laventure\Component\Database\Schema\Blueprint\Drivers;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;


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
     * Add mysql column
     *
     * @param string $name
     *
     * @param string $type
     *
     * @param string $constraints
     *
     * @return Column
    */
    protected function addColumn(string $name, string $type, string $constraints = 'NOT NULL'): Column
    {
        return parent::addColumn("`$name`", $type, $constraints); // TODO: Change the autogenerated stub
    }








    /**
     * @inheritDoc
    */
    public function increments(string $name): Column
    {
        return $this->bigIncrements($name)->primaryKey();
    }






    /**
     * @inheritDoc
    */
    public function integer(string $name, int $length = 11): Column
    {
         return $this->addColumn($name, "INT($length)");
    }







    /**
     * @inheritDoc
    */
    public function smallInteger(string $name): Column
    {
         return $this->addColumn($name, 'SMALLINT');
    }






    /**
     * @inheritDoc
    */
    public function bigInteger(string $name): Column
    {
         return $this->addColumn($name, 'BIGINT');
    }






    /**
     * @inheritDoc
    */
    public function bigIncrements(string $name): Column
    {
        return $this->addColumn($name, 'BIGINT AUTO_INCREMENT');
    }






    /**
     * @inheritDoc
    */
    public function datetime(string $name): Column
    {
        return $this->addColumn($name, 'DATETIME');
    }
}