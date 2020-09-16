<?php
namespace PGPHPLIB\DML\Types;

abstract class DataType
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
    
    abstract public function transform();
}
