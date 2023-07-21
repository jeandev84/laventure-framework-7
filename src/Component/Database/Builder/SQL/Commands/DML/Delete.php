<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\SQLBuilderConditions;


/**
 * @inheritdoc
*/
class Delete extends SQLBuilderConditions implements DeleteBuilderInterface
{

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
        return parent::execute();
    }
}