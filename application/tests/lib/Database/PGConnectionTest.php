<?php

use PGPHPLIB\Database\PGConnection;
use PHPUnit\Framework\TestCase;

class PGConnectionTest extends TestCase
{
    public function test_it_shoud_be_able_return_pg_connection()
    {
        $conn = new PGConnection([
            'name' => 'postgres',
            'host' => 'database',
            'port' => 5432,
            'user' => 'postgres',
            'pass' => 'secret',
        ]);

        $this->assertInstanceOf(PDO::class, $conn->open());
    }
}
