<?php

use PGPHPLIB\DML\Types\NullType;
use PHPUnit\Framework\TestCase;

class NullTypeTest extends TestCase
{
    public function test_it_should_return_a_null_type_transformed()
    {
        $null = new NullType(null);

        $this->assertEquals("NULL", $null->transform());
    }
}
