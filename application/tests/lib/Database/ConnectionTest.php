<?php

use PGPHPLIB\Database\Connection;
use PHPUnit\Framework\TestCase;

class ConnectionTest extends TestCase
{
    public function test_it_shoud_be_able_return_pdo_connection()
    {
        $pdoMock = $this->createMock(PDO::class);
        /** @var  Connection&\PHPUnit\Framework\MockObject\MockObject $mockConn */
        $mockConn = $this->getMockBuilder(Connection::class)
                            ->setConstructorArgs([['foo' => 'bar']])
                            ->getMockForAbstractClass();
        $mockConn->method('open')->willReturn($pdoMock);

        $this->assertInstanceOf(PDO::class, $mockConn->open());
    }
}
