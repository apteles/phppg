<?php
namespace PGPHPLIB\DML\Types;

class NumberType extends DataType
{
    public function transform():int
    {
        if (!is_integer($this->value)) {
            throw new TypeException('Invalid Type');
        }
        
        return $this->value;
    }
}
