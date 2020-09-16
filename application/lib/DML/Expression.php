<?php
namespace PGPHPLIB\DML;

abstract class Expression
{
    public const AND_OP = 'AND ';

    public const OR_OP = 'OR ';
    
    abstract public function dump():string;
}
