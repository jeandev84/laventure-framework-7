<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\HasConditions;
use Laventure\Component\Database\Builder\SQL\Commands\SQlBuilder;


/**
 * @inheritdoc
*/
class Delete extends SQlBuilder implements DeleteBuilderInterface
{

    use HasConditions;



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $sql[] = sprintf('DELETE FROM %s', $this->getTable());
        $sql[] = $this->whereSQL();

        return join(' ', array_filter($sql)) . ";";
    }





    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
        return $this->statement()->execute();
    }
}