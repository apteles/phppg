<?php
namespace PGPHPLIB\DML;

abstract class Instruction
{
    protected string $sql;

    protected string $table;

    final public function setTable(string $table)
    {
        $this->table = $table;
    }

    final public function getTable(): string
    {
        return $this->table;
    }

    abstract public function getInstruction(): string;
}
