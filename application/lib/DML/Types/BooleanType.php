<?php
namespace PGPHPLIB\DML\Types;

class BooleanType extends DataType
{
    public function transform():string
    {
        return $this->value ? 'TRUE' : 'FALSE';
    }
}
