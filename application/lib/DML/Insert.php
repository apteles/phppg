<?php
namespace PGPHPLIB\DML;

use PGPHPLIB\DML\Types\BooleanType;
use PGPHPLIB\DML\Types\NullType;
use PGPHPLIB\DML\Types\StringType;

class Insert extends Instruction
{
    private array $columns = [];

    private array $values = [
        'labeled' => [],
        'raw'   => []
    ];

    public function __construct(string $tableName)
    {
        $this->setTable($tableName);
    }
    /**
     * indexed array contain colum and values, example:
     * ['name' => 'john doe','email' => 'johndoe@domain.com', 'password' => 123456]
     */
    public function data(array $data): void
    {
        $this->setColumns($data);
        $this->setValues($data);
    }

    private function setColumns(array $data): void
    {
        $this->columns[] = array_keys($data);
    }

    private function setValues(array $data): void
    {
        $this->values['raw'] = $this->transformValidDataType($data);
        $this->values['labeled'] = $this->createLabels($data);
    }

    public function getRawValues(): array
    {
        return $this->values['raw'];
    }

    private function transformValidDataType(array $data): array
    {
        $columnsTransformed = [];

        $columns = array_values($data);

        foreach ($columns as $colum) {
            if (is_string($colum)) {
                $columnsTransformed[] = (new StringType($colum))->transform();
            } elseif (is_bool($colum)) {
                $columnsTransformed[] = (new BooleanType($colum))->transform();
            } elseif (is_null($colum)) {
                $columnsTransformed[] = (new NullType($colum))->transform();
            } else {
                $columnsTransformed[] = $colum;
            }
        }

        return $columnsTransformed;
    }
    private function createLabels(array $data): array
    {
        return array_map(function ($column) {
            return ":{$column}";
        }, array_keys($data));
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
