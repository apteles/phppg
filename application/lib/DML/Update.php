<?php
namespace PGPHPLIB\DML;

use PGPHPLIB\DML\Types\BooleanType;
use PGPHPLIB\DML\Types\NullType;
use PGPHPLIB\DML\Types\StringType;

class Update extends Instruction implements CriteriaInstructionInterface
{
    private Criteria $criteria;

    private TransformQueryValues $transformValues;
    
    private array $columns = [];

    public function __construct(string $tableName)
    {
        $this->setTable($tableName);
        $this->criteria = new Criteria;
        /**
         *  $update = new Update('users')
         *
         *  $update->data(['name' => 'john doe', 'email' => 'john.doe@gmail.com']);
         *  $update->criteria(new Filter('foo','=','bar'));
         *  $update->criteria(new Filter('bazz','>',30))
         *
         *  $update->getInstruction();
         *
         */
    }

    /**
     * indexed array contain colum and values, example:
     * ['name' => 'john doe','email' => 'johndoe@domain.com', 'password' => 123456]
     */
    public function data(array $data): void
    {
        $this->setColumns($data);
        $this->transformValues = new TransformQueryValues($data);
    }

    private function setColumns(array $data): void
    {
        $this->columns[] = array_keys($data);
    }

    public function getInstruction(): string
    {
        $columns = implode(", ", $this->columns[0]);
        $values = implode(", ", $this->values['labeled']);

        return sprintf("INSERT INTO %s (%s) VALUES (%s)", $this->table, $columns, $values);
    }
}


//INSERT INTO <TABLE> (COLUMN1,COLUMN2) VALUES (VAL1,VAL2)

// SELECT * FROM <TABLE> WHERE <CRITERIA>
// UPDATE <TABLE> SET COLUM1 = VAL1, COLUMN2 = VAL2 WHERE <CRITERIA>
// DELETE FROM <TABLE> WHERE <CRITERIA>
/**
 *
 * CRITERIA:
 *  - SELECT
 *  - UPDATE
 *  - DELETE
 * COLUMNS:
 *  - INSERT
 *  - SELECT
 *  - UPDATE
 *
 *
 *
 */
// new Insert('users')->data(['name' => 'john doe', 'email' => 'john@mail.com'])->getInstruction();
