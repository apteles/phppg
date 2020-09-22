<?php

use PGPHPLIB\DML\Insert;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    public function test_it_should_generate_an_instruction_of_sql_insert_valid()
    {
        $insert = new Insert('users');
        $insert->data(['name' => 'john', 'email'=> 'john@domain.com']);
        
        $this->assertEquals("INSERT INTO users (name, email) VALUES (:name, :email)", $insert->getInstruction());
    }

    public function test_it_should_be_able_get_the_raw_vales_parsed()
    {
        $insert = new Insert('users');
        $insert->data(['name' => 'john', 'email'=> 'john@domain.com','isAdmin' => false, 'has_debts' => null]);
        
        $this->assertEquals($insert->getRawValues()[0], "'john'");
        $this->assertEquals($insert->getRawValues()[1], "'john@domain.com'");
        $this->assertEquals($insert->getRawValues()[2], "FALSE");
        $this->assertEquals($insert->getRawValues()[3], "NULL");
    }
}
