<?php

use PGPHPLIB\DML\Types\ArrayType;
use PGPHPLIB\DML\Types\TypeException;
use PHPUnit\Framework\TestCase;

class ArrayTypeTest extends TestCase
{
    public function test_it_should_return_a_string_formated()
    {
        $arr = new ArrayType(['F','M']);

        $this->assertEquals("('F','M')", $arr->transform());
    }

    public function test_it_should_return_a_number_formated()
    {
        $arr = new ArrayType([18,20,34]);

        $this->assertEquals("(18,20,34)", $arr->transform());
    }

    public function test_it_should_return_an_error_if_a_wrong_type_is_passed()
    {
        $this->expectException(TypeException::class);

        $arr = new ArrayType(20);
        $this->assertEquals("(20)", $arr->transform());

        $arr = new ArrayType('F');
        $this->assertEquals("(F)", $arr->transform());
    }
}
