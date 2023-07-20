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
        $columns = $this->builder->buildNewColumns();
        $sql     = sprintf("CREATE TABLE IF NOT EXISTS %s (%s);", $this->getTable(), $columns);

        return $columns ? $this->exec($sql) : false;
    }







    /**
     * @inheritDoc
    */
    public function updateTable(): bool
    {
         return $this->exec('');
    }





    /**
     * @inheritDoc
    */
    public function dropTable(): bool
    {
         return $this->exec(sprintf('DROP TABLE %s;', $this->getTable()));
    }






    /**
     * @inheritDoc
    */
    public function dropTableIfExists(): bool
    {
        return $this->exec(sprintf('DROP TABLE IF EXISTS %s;', $this->getTable()));
    }






    /**
     * @inheritDoc
    */
    public function truncateTable(): bool
    {
        return $this->exec(sprintf('TRUNCATE TABLE %s;', $this->getTable()));
    }








    /**
     * @inheritDoc
    */
    public function truncateTableCascade(): bool
    {
        return $this->exec(sprintf('TRUNCATE TABLE CASCADE %s;', $this->getTable()));
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
    public function addColumn(string $name, string $type, string $constraints = 'NOT NULL'): Column
    {
        return parent::addColumn("$name", $type, $constraints);
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

    /**
     * @inheritDoc
     */
    public function binary(string $name): Column
    {
        // TODO: Implement binary() method.
    }

    /**
     * @inheritDoc
     */
    public function date(string $name): Column
    {
        // TODO: Implement date() method.
    }

    /**
     * @inheritDoc
     */
    public function decimal(string $name, int $precision, int $scale): Column
    {
        // TODO: Implement decimal() method.
    }

    /**
     * @inheritDoc
     */
    public function double(string $name, int $precision, int $scale): Column
    {
        // TODO: Implement double() method.
    }

    /**
     * @inheritDoc
     */
    public function enum(string $name, array $values): Column
    {
        // TODO: Implement enum() method.
    }

    /**
     * @inheritDoc
     */
    public function float(string $name): Column
    {
        // TODO: Implement float() method.
    }

    /**
     * @inheritDoc
     */
    public function json(string $name): Column
    {
        // TODO: Implement json() method.
    }

    /**
     * @inheritDoc
     */
    public function longText(string $name): Column
    {
        // TODO: Implement longText() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumInteger(string $name): Column
    {
        // TODO: Implement mediumInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumText(string $name): Column
    {
        // TODO: Implement mediumText() method.
    }

    /**
     * @inheritDoc
     */
    public function morphs(string $name): Column
    {
        // TODO: Implement morphs() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyInteger(string $name): Column
    {
        // TODO: Implement tinyInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function char(string $name, $value): Column
    {
        // TODO: Implement char() method.
    }

    /**
     * @inheritDoc
     */
    public function time(string $name): Column
    {
        // TODO: Implement time() method.
    }

    /**
     * @inheritDoc
     */
    public function default($value)
    {
        // TODO: Implement default() method.
    }

    /**
     * @inheritDoc
     */
    public function nullable(): mixed
    {
        // TODO: Implement nullable() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamp(string $name): Column
    {
        // TODO: Implement timestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function unsigned(): void
    {
        // TODO: Implement unsigned() method.
    }





    /**
     * @inheritDoc
    */
    public function getTableColumns(): array
    {
         $statement = $this->statement("SHOW FULL COLUMNS FROM {$this->getTable()}");

         $columns = $statement->fetch()->assoc();

         return array_filter($columns, function ($column) {
              return $column['Field'];
         });
    }




    /**
     * @param string $name
     *
     * @return bool
    */
    public function hasColumn(string $name): bool
    {
        $statement = $this->statement("SHOW FULL COLUMNS FROM {$this->getTable()} LIKE '$name'");

        return $statement->fetch()->numRows();
    }
}