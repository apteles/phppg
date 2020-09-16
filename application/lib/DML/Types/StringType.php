<?php
namespace PGPHPLIB\DML\Types;

class StringType extends DataType
{
    public function transform():string
    {
        return "'$this->value'";
    }
}
