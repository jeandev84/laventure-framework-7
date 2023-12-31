<?php
namespace Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\DML\Contract\UpdateBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\HasConditions;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\HasAttributes;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\HasCriteriaInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\IsSettable;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\SQlBuilder;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\SQLBuilderConditions;


/**
 * @inheritdoc
*/
class Update extends SQLBuilderConditions implements UpdateBuilderInterface
{

    use HasConditions, IsSettable;


    /**
     * @inheritdoc
    */
    public function attributes(array $attributes): static
    {
         $this->setParameters($attributes);

         return $this->data($this->resolveBindingParameters($attributes));
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
        return parent::execute();
    }
}