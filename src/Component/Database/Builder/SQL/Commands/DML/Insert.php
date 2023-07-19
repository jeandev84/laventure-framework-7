<?php
namespace Laventure\Component\Database\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Builder\SQL\Commands\DML\Contract\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Commands\HasAttributeResolvable;
use Laventure\Component\Database\Builder\SQL\Commands\SQlBuilder;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;


/**
 * @inheritdoc
*/
class Insert extends SQlBuilder implements InsertBuilderInterface
{

    use HasAttributeResolvable;


    /**
     * @var int
    */
    protected int $index = 0;




    /**
     * @var array
    */
    protected array $columns = [];



    /**
     * @var array
    */
    protected array $values = [];




    /**
     * @inheritDoc
    */
    public function attributes(array $attributes): static
    {
         if (! empty($attributes[0])) {
             foreach ($attributes as $attribute) {
                  $this->add($attribute);
             }
         } else {
             $this->add($attributes);
         }

         return $this;
    }





    /**
     * @param array $attributes
     *
     * @return $this
    */
    private function add(array $attributes): static
    {
         $attributes      = $this->resolveAttributes($this->connection, $attributes);
         $this->columns   = array_keys($attributes);
         $this->values[]  = '('. join(', ', array_values($attributes)) . ')';

         $this->index++;

         return $this;
    }





    /**
     * @inheritdoc
    */
    protected function resolveAttributes(ConnectionInterface $connection, array $attributes): array
    {
          $resolved = [];

          foreach ($attributes as $column => $value) {
               if ($connection instanceof PdoConnection) {
                    $resolved[$column] = ":{$column}_{$this->index}";
                    $this->setParameter("{$column}_{$this->index}", $value);
               } else {
                   $resolved[$column] = $this->resolveAttributeValue($value);
               }
          }

          return $resolved;
    }







    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
         return $this->columns;
    }




    /**
     * @inheritDoc
    */
    public function getValues(): array
    {
        return $this->values;
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $columns = join(', ', $this->getColumns());
        $values  = join(', ', $this->getValues());

        return sprintf("INSERT INTO {$this->getTable()} (%s) VALUES %s;", $columns, $values);
    }





    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
        return $this->statement()->execute();
    }
}