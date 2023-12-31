<?php
namespace Laventure\Component\Database\Schema\Blueprint\Column;

use Laventure\Component\Database\Schema\Blueprint\Column\Contract\ColumnInterface;


/**
 * @inheritdoc
*/
class Column implements ColumnInterface
{

    /**
     * Column name
     *
     * @var string
    */
    protected string $name;


    /**
     * Column type and length
     *
     * @var string
    */
    protected string $type;




    /**
     * Column constraints
     *
     * @var string
    */
    protected string $constraints;







    /**
     * Column collation
     *
     * @var string
    */
    protected string $collation;






    /**
     * Column comments
     *
     * @var string
    */
    protected string $comments;





    /**
     * @var bool
    */
    protected bool $primaryKey = false;





    /**
     * @var string
    */
    protected string $signed = '';







    /**
     * @param string $name
     *
     * @param string $type
     *
     * @param string $constraints
    */
    public function __construct(string $name, string $type, string $constraints = '')
    {
         $this->name = $name;
         $this->type = $type;
         $this->constraints = $constraints ?: 'NOT NULL';
    }






    /**
     * @return $this
    */
    public function primaryKey(): static
    {
        $this->constraints = 'PRIMARY KEY';

        $this->primaryKey = true;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        if ($this->signed) {
            return sprintf('%s %s', $this->type, $this->signed);
        }

        return $this->type;
    }







    /**
     * @inheritDoc
    */
    public function getComments(): string
    {
        return $this->comments;
    }




    /**
     * @inheritDoc
    */
    public function getCollation(): string
    {
        return $this->collation;
    }




    /**
     * @inheritDoc
    */
    public function isPrimaryKey(): bool
    {
        return $this->primaryKey;
    }






    /**
     * @return $this
    */
    public function unsigned(): static
    {
         $this->signed = "UNSIGNED";

         return $this;
    }







    /**
     * @return $this
    */
    public function signed(): static
    {
        $this->signed = "SIGNED";

        return $this;
    }





    /**
     * @return $this
    */
    public function nullable(): static
    {
        $this->constraints = "DEFAULT NULL";

        return $this;
    }







    /**
     * @param $value
     *
     * @return $this
    */
    public function default($value): static
    {
        $this->constraints = sprintf('DEFAULT "%s" NOT NULL', $value);

        return $this;
    }







    /**
     * @return $this
    */
    public function unique(): static
    {
        $this->constraints = 'UNIQUE';

        return $this;
    }







    /**
     * @inheritdoc
    */
    public function getConstraints(): string
    {
        return $this->constraints;
    }







    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return join(' ', array_filter([
            $this->getName(),
            $this->getType(),
            $this->getConstraints()
        ]));
    }
}