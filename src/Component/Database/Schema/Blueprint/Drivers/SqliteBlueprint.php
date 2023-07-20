<?php
namespace Laventure\Component\Database\Schema\Blueprint\Drivers;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;


/**
 * @inheritdoc
*/
class SqliteBlueprint extends Blueprint
{

    /**
     * @inheritDoc
    */
    public function createTable(): bool
    {
        // TODO: Implement createTable() method.
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
        // TODO: Implement dropTableIfExists() method.
    }

    /**
     * @inheritDoc
     */
    public function increments(string $name): Column
    {
        // TODO: Implement increments() method.
    }

    /**
     * @inheritDoc
     */
    public function integer(string $name, int $length = 11): Column
    {
        // TODO: Implement integer() method.
    }

    /**
     * @inheritDoc
     */
    public function smallInteger(string $name): Column
    {
        // TODO: Implement smallInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigInteger(string $name): Column
    {
        // TODO: Implement bigInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigIncrements(string $name): Column
    {
        // TODO: Implement bigIncrements() method.
    }

    /**
     * @inheritDoc
     */
    public function datetime(string $name): Column
    {
        // TODO: Implement datetime() method.
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
    public function truncateTable(): mixed
    {
        // TODO: Implement truncateTable() method.
    }

    /**
     * @inheritDoc
     */
    public function truncateTableCascade(): mixed
    {
        // TODO: Implement truncateTableCascade() method.
    }

    /**
     * @inheritDoc
     */
    public function describeTable(): mixed
    {
        // TODO: Implement describeTable() method.
    }
}