<?php
namespace PGPHPLIB\DML;

use PGPHPLIB\DML\Types\DataType;

class Filter extends Expression
{
    private string $column;

    private string $operator;

    /**
     * @param mixed $value
     */
    private $value;

    public function __construct(string $column, string $operator, DataType $value)
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value->transform();
    }
    
    public function dump():string
    {
        return "{$this->column} {$this->operator} {$this->value}";
    }
}
