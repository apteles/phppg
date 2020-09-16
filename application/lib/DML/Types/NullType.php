<?php
namespace PGPHPLIB\DML\Types;

class NullType extends DataType
{
    public function transform():string
    {
        return "NULL";
    }
}
