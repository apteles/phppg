<?php

use PGPHPLIB\DML\Types\DataType;
use PHPUnit\Framework\TestCase;

class DataTypeTest extends TestCase
{
    public function test_it_should_be_able_implement_method_transform()
    {
        /** @var  DataType&\PHPUnit\Framework\MockObject\MockObject $mockStrType */
        $mockStrType = $this->getMockBuilder(DataType::class)
        ->setConstructorArgs(['age'])
        ->getMockForAbstractClass();

        $mockStrType->method('transform')->willReturn("'age'");

        $this->assertEquals("'age'", $mockStrType->transform());
    }
}
