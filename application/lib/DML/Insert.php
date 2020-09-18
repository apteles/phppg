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
            if (is_scalar($colum)) {
                $columnTransformed[] = $colum;
            }
            if (is_string($colum)) {
                $columnTransformed[] = (new StringType($colum))->transform();
            }
            if (is_bool($colum)) {
                $columnTransformed[] = (new BooleanType($colum))->transform();
            }
            if (is_null($colum)) {
                $columnTransformed[] = (new NullType($colum))->transform();
            }
        }
        var_dump($columnsTransformed);
        
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
        var_dump($this->values['labeled']);
        var_dump($this->values['raw']);
        die;
        return "

            INSERT INTO {$this->getTable()}
            (.". implode(", ", $this->values['labeled']) .".)
            VALUES
            (.". implode(", ", $this->values['labeled']) .".)
        ";
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
