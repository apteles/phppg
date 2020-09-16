<?php

use PGPHPLIB\DML\Types\StringType;
use PHPUnit\Framework\TestCase;

class StringTypeTest extends TestCase
{
    public function test_it_should_return_a_string_transformed()
    {
        $str = new StringType('foo');

        $this->assertEquals("'foo'", $str->transform());
    }
}
