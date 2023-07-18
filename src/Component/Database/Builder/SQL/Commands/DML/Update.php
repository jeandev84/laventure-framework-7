<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\HasConditions;
use Laventure\Component\Database\Builder\SQL\Commands\HasAttributeResolvable;
use Laventure\Component\Database\Builder\SQL\Commands\IsSettable;
use Laventure\Component\Database\Builder\SQL\Commands\SQlBuilder;


/**
 * @inheritdoc
*/
class Update extends SQlBuilder implements UpdateBuilderInterface
{


    use HasConditions, IsSettable, HasAttributeResolvable;


    /**
     * @param array $attributes
     *
     * @return $this
    */
    public function attributes(array $attributes): static
    {
         $this->setParameters($attributes);

         return $this->data($this->resolveAttributes($this->connection, $attributes));
    }








    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $sql[] = sprintf("UPDATE %s %s", $this->getTable(), $this->setSQL());
        $sql[] = $this->whereSQL();

        return join(' ', array_filter($sql)).';';
    }





    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
        return $this->statement()->execute();
    }
}