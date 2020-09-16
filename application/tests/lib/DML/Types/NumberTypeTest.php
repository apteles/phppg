<?php

use PGPHPLIB\DML\Types\NumberType;
use PGPHPLIB\DML\Types\TypeException;
use PHPUnit\Framework\TestCase;

class NumberTypeTest extends TestCase
{
    public function test_it_should_return_a_number()
    {
        $number = new NumberType(300);

        $this->assertIsInt(300, $number->transform());
    }

    public function test_it_should_throw_expection_if_type_is_not_a_integer()
    {
        $this->expectException(TypeException::class);
        $number = new NumberType('300');

        $this->assertIsInt(300, $number->transform());
    }
}
