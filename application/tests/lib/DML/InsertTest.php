<?php

use PGPHPLIB\DML\Insert;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    public function test_it_should()
    {
        $insert = new Insert('table');
        $insert->data(['name' => 'john', 'email'=> 'john@domain.com']);
        
        var_dump($insert->getInstruction());
    }
}
