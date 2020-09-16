<?php

use PGPHPLIB\DML\Criteria;
use PGPHPLIB\DML\Expression;
use PGPHPLIB\DML\Filter;
use PGPHPLIB\DML\Types\ArrayType;
use PGPHPLIB\DML\Types\NumberType;
use PGPHPLIB\DML\Types\StringType;
use PHPUnit\Framework\TestCase;

class CriteriaTest extends TestCase
{
    public function test_it_should_return_age_greater_than_18()
    {
        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(NumberType::class)->setConstructorArgs([18])->getMock();
        $mockType->method('transform')->will($this->returnValue(18));

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter */
        $mockFilter = $this->getMockBuilder(Filter::class)->setConstructorArgs(['age', '>', $mockType])->getMock();
        $mockFilter->method('dump')->willReturn('age > 18');

        $criteria = new Criteria();
        $criteria->add($mockFilter);

        $this->assertEquals('( age > 18 )', $criteria->dump());
    }

    public function test_it_should_return_age_greater_than_18_and_less_than_60()
    {
        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(NumberType::class)->setConstructorArgs([18])->getMock();
        $mockType->method('transform')->will($this->returnValue(18));

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter */
        $mockFilter = $this->getMockBuilder(Filter::class)->setConstructorArgs(['age', '>', $mockType])->getMock();
        $mockFilter->method('dump')->willReturn('age > 18');


        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType2 */
        $mockType2 = $this->getMockBuilder(NumberType::class)->setConstructorArgs([60])->getMock();
        $mockType2->method('transform')->will($this->returnValue(18));

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter2 */
        $mockFilter2 = $this->getMockBuilder(Filter::class)->setConstructorArgs(['age', '>', $mockType2])->getMock();
        $mockFilter2->method('dump')->willReturn('age < 60');

        $criteria = new Criteria();
        $criteria->add($mockFilter);
        $criteria->add($mockFilter2);

        $this->assertEquals('( age > 18 AND age < 60 )', $criteria->dump());
    }

    public function test_it_should_be_able_create_in_and_not_in_expression()
    {
        /** @var  ArrayType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(ArrayType::class)->setConstructorArgs([[24,25,26]])->getMock();
        $mockType->method('transform')->willReturn('(24,25,26)');

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter */
        $mockFilter = $this->getMockBuilder(Filter::class)->setConstructorArgs(['age', 'IN', $mockType])->getMock();
        $mockFilter->method('dump')->willReturn('age IN (24,25,26)');


        /** @var  ArrayType&\PHPUnit\Framework\MockObject\MockObject $mockType2 */
        $mockType2 = $this->getMockBuilder(ArrayType::class)->setConstructorArgs([[12,13,15]])->getMock();
        $mockType2->method('transform')->willReturn('(12,15,15)');

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter2 */
        $mockFilter2 = $this->getMockBuilder(Filter::class)->setConstructorArgs(['age', 'NOT IN', $mockType2])->getMock();
        $mockFilter2->method('dump')->willReturn('age NOT IN (12,13,15)');

        $criteria = new Criteria();
        $criteria->add($mockFilter);
        $criteria->add($mockFilter2);

        var_dump($criteria->dump());

        $this->assertEquals('( age IN (24,25,26) AND age NOT IN (12,13,15) )', $criteria->dump());
    }

    public function test_it_should_be_ablecreate_in_expression()
    {
        /** @var  StringType&\PHPUnit\Framework\MockObject\MockObject $mockType */
        $mockType = $this->getMockBuilder(StringType::class)->setConstructorArgs(['F'])->getMock();
        $mockType->method('transform')->willReturn('F');

        /** @var  NumberType&\PHPUnit\Framework\MockObject\MockObject $mockType2 */
        $mockType2 = $this->getMockBuilder(NumberType::class)->setConstructorArgs([16])->getMock();
        $mockType2->method('transform')->willReturn(16);

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter */
        $mockFilter = $this->getMockBuilder(Filter::class)->setConstructorArgs(['sexo', '=', $mockType])->getMock();
        $mockFilter->method('dump')->willReturn("sexo = 'F'");

        /** @var  Filter&\PHPUnit\Framework\MockObject\MockObject $mockFilter2 */
        $mockFilter2 = $this->getMockBuilder(Filter::class)->setConstructorArgs(['age', '<', $mockType2])->getMock();
        $mockFilter2->method('dump')->willReturn("age < 16");

        $criteria = new Criteria();
        $criteria->add($mockFilter);
        $criteria->add($mockFilter2, Expression::OR_OP);

        var_dump($criteria->dump());

        $this->assertEquals("( sexo = 'F' OR age < 16 )", $criteria->dump());
    }
}
