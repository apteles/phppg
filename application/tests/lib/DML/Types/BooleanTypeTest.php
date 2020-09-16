<?php

use PGPHPLIB\DML\Types\BooleanType;
use PHPUnit\Framework\TestCase;

class BooleanTypeTest extends TestCase
{
    public function test_it_should_return_a_true_type_transformed()
    {
        $true = new BooleanType(true);
        $this->assertEquals("TRUE", $true->transform());
    }

    public function test_it_should_return_a_false_type_transformed()
    {
        $false = new BooleanType(false);

        $this->assertEquals("FALSE", $false->transform());
    }
}
