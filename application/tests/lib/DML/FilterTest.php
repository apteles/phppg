<?php

use PGPHPLIB\DML\Filter;
use PGPHPLIB\DML\Types\ArrayType;
use PGPHPLIB\DML\Types\NumberType;
use PGPHPLIB\DML\Types\StringType;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
    public function test_it_should_return_age_greater_than_18()
    {
        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(NumberType::class)->setConstructorArgs([18])->getMock();
        $mockType->method('transform')->will($this->returnValue(18));

        $filter = new Filter('age', '>', $mockType);

        $this->assertEquals('age > 18', $filter->dump());
    }

    public function test_it_should_return_date_equal_to_01_01_2001()
    {
        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(StringType::class)->setConstructorArgs(['01-01-2001'])->getMock();
        $mockType->method('transform')->will($this->returnValue("'01-01-2001'"));

        $filter = new Filter('date', '=', $mockType);
        /**
         * Instead of use a type class for each type for mapping to a type correspond to type SQL, consider use a factory
         * a pattern static factory using splat operator (see: https://www.php.net/manual/pt_BR/migration56.new-features.php).
         */

        $this->assertEquals("date = '01-01-2001'", $filter->dump());
    }

    public function test_it_should_return_string_of_options()
    {
        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(ArrayType::class)->setConstructorArgs(['F','M'])->getMock();
        $mockType->method('transform')->will($this->returnValue("('F','M')"));

        $filter = new Filter('sexo', 'IN', $mockType);
     

        $this->assertEquals("sexo IN ('F','M')", $filter->dump());
    }
}
