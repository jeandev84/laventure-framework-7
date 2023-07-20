<?php
namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\Column\AddColumn;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;
use Laventure\Component\Database\Schema\Blueprint\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Blueprint\Indexes\Index;
use Laventure\Component\Database\Schema\Blueprint\Constraints\ForeignKey;
use Laventure\Component\Database\Schema\Blueprint\Constraints\PrimaryKey;
use Laventure\Component\Database\Schema\Blueprint\Constraints\Unique;


/**
 * @inheritdoc
*/
abstract class Blueprint implements BlueprintInterface
{


        /**
        * @var ConnectionInterface
        */
        protected ConnectionInterface $connection;



        /**
        * @var string
        */
        protected string $table;





        /**
        * @var BlueprintBuilder
        */
        protected BlueprintBuilder $builder;




        /**
         * @param ConnectionInterface $connection
         *
         * @param string $table
        */
        public function __construct(ConnectionInterface $connection, string $table)
        {
             $this->connection  = $connection;
             $this->table       = $table;
             $this->builder     = new BlueprintBuilder();
        }






        /**
         * Add primary keys
         *
         * @param string|array $columns
         *
         * @return $this
        */
        public function primary(string|array $columns): static
        {
             $this->builder->addConstraint(new PrimaryKey($columns));

             return $this;
        }






        /**
         * @param string|array $columns
         *
         * @return $this
        */
        public function unique(string|array $columns): static
        {
              $this->builder->addConstraint(new Unique($columns));

              return $this;
        }








        /**
         * Add indexes columns
         *
         * @param string|array $columns
         *
         * @return $this
        */
        public function index(string|array $columns): static
        {
             $this->builder->addIndex(new Index($columns));

             return $this;
        }





        /**
         * @param string $name
         *
         * @return ForeignKey
        */
        public function foreign(string $name): ForeignKey
        {
             return $this->builder->addForeignKey(new ForeignKey($name, $this->foreignKeyName($name)));
        }





        /**
         * @return ForeignKey
        */
        public function foreignId(): ForeignKey
        {
             return $this->foreign('id');
        }








        /**
         * @param string $name
         *
         * @return string
        */
        protected function foreignKeyName(string $name): string
        {
            return sprintf('fk_%s_%s', $this->table, $name);
        }






        /**
         * Add column named id
         *
         * @return Column
        */
        public function id(): Column
        {
            return $this->increments('id');
        }







        /**
         * @return void
        */
        public function timestamps(): void
        {
            $this->datetime('created_at');
            $this->datetime('updated_at');
        }







       /**
        * Add Nullable timestamps
       */
       public function nullableTimestamps(): void
       {
          $this->datetime('created_at')->nullable();
          $this->datetime('updated_at')->nullable();
       }








        /**
         * @return Column
        */
        public function softDeletes(): Column
        {
            return $this->boolean('deleted_at');
        }







        /**
         * @inheritdoc
        */
        public function getTable(): string
        {
            return $this->table;
        }





        /**
         * @return ConnectionInterface
        */
        public function getConnection(): ConnectionInterface
        {
            return $this->connection;
        }







        /**
         * @param string $name
         *
         * @param string $type
         *
         * @param string $constraints
         *
         * @return Column
        */
        public function addColumn(string $name, string $type, string $constraints = ''): Column
        {
             if (! in_array($name, $this->getTableColumns())) {
                 return $this->builder->addColumn(new Column($name, $type, $constraints));
             }

             return $this->builder->alterColumn(new AddColumn($name, $type, $constraints));
        }






        /**
         * @param string $name
         *
         * @param int $length
         *
         * @return Column
        */
        public function string(string $name, int $length = 255): Column
        {
             return $this->addColumn($name, "VARCHAR($length)");
        }





        /**
         * Adds remember_token as VARCHAR(100) NULL
         *
         * @return Column
        */
        public function rememberToken(): Column
        {
             return $this->string('remember_token', 100)->nullable();
        }





        /**
         * Add column type boolean
         *
         * @param string $name
         *
         * @return Column
        */
        public function boolean(string $name): Column
        {
             return $this->addColumn($name, 'BOOLEAN');
        }








        /**
         * Add column text
         *
         * @param string $name
         *
         * @return Column
        */
        public function text(string $name): Column
        {
            return $this->addColumn($name, 'TEXT');
        }






        /**
         * @implements
        */
        abstract public function getTableColumns(): array;




        /**
        * @inheritdoc
        */
        abstract public function createTable(): bool;






        /**
        * @inheritdoc
        */
        abstract public function updateTable(): bool;





        /**
        * @inheritdoc
        */
        abstract public function dropTable(): bool;





        /**
        * @inheritdoc
        */
        abstract public function dropTableIfExists(): bool;






        /**
         * Add increment column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function increments(string $name): Column;





        /**
         * @param string $name
         *
         * @param int $length
         *
         * @return Column
        */
        abstract public function integer(string $name, int $length = 11): Column;






        /**
         * Add small integer
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function smallInteger(string $name): Column;





        /**
         * @param string $name
         *
         * @return Column
        */
        abstract public function bigInteger(string $name): Column;







        /**
         * @param string $name
         *
         * @return Column
        */
        abstract public function bigIncrements(string $name): Column;






        /**
         * Add datetime column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function datetime(string $name): Column;







        /**
         * Add binary column
         *
         * @param string $name
         * @return Column
        */
        abstract public function binary(string $name): Column;









        /**
         * Add date column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function date(string $name): Column;









        /**
         * Add decimal column
         *
         * @param string $name
         *
         * @param int $precision
         *
         * @param int $scale
         *
         * @return Column
        */
        abstract public function decimal(string $name, int $precision, int $scale): Column;








        /**
         * Add double column
         *
         * @param string $name
         *
         * @param int $precision
         *
         * @param int $scale
         *
         * @return Column
        */
        abstract public function double(string $name, int $precision, int $scale): Column;









        /**
         * Add eum column
         *
         * @param string $name
         *
         * @param array $values
         *
         * @return Column
        */
        abstract public function enum(string $name, array $values): Column;









        /**
         * Add float column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function float(string $name): Column;









        /**
         * Add json column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function json(string $name): Column;






        /**
         * Add long text
         *
         * @param string $name
         * @return Column
        */
        abstract public function longText(string $name): Column;






        /**
         * Add medium integer
         *
         * @param string $name
         * @return Column
        */
        abstract public function mediumInteger(string $name): Column;








        /**
         * Add medium text
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function mediumText(string $name): Column;









        /**
         * Add morphs column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function morphs(string $name): Column;








        /**
         * Add tiny column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function tinyInteger(string $name): Column;






        /**
         * @param string $name
         *
         * @param $value
         *
         * @return Column
        */
        abstract public function char(string $name, $value): Column;







        /**
         * Add time column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function time(string $name): Column;






        /**
         * Set column default value
         *
         * @param $value
        */
        abstract public function default($value);






        /**
         * Designate that the column allows NULL values
         *
         * @return mixed
        */
        abstract public function nullable(): mixed;








        /**
         * Add TIMESTAMP column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function timestamp(string $name): Column;







        /**
         * Set INTEGER to UNSIGNED
         *
         * @return void
        */
        abstract public function unsigned(): void;

}