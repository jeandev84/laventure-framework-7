<?php
namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Blueprint\Column\Column;
use Laventure\Component\Database\Schema\Blueprint\Column\ColumnCollection;


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
        * @var ColumnCollection
        */
        protected ColumnCollection $columns;




        /**
         * @var array
        */
        protected array $primaryKeys = [];




        /**
         * @param ConnectionInterface $connection
         *
         * @param string $table
        */
        public function __construct(ConnectionInterface $connection, string $table)
        {
             $this->connection = $connection;
             $this->table      = $table;
             $this->columns    = new ColumnCollection();
        }







        /**
         * Add column
         *
         * @param Column $column
         *
         * @return Column
        */
        public function add(Column $column): Column
        {
            return $this->columns->addColumn($column);
        }






        /**
         * @return Column[]
        */
        public function getColumns(): array
        {
             return $this->columns->getColumns();
        }







        /**
         * Print table columns
        */
        public function printTableColumns(): string
        {
            return join(", \n", array_values($this->getColumns()));
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
         * @return Column
        */
        public function addColumn(string $name, string $type): Column
        {
             return $this->add(new Column($name, $type));
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
         * Add datetime column
         *
         * @param string $name
         *
         * @return Column
        */
        abstract public function datetime(string $name): Column;

}