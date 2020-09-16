<?php
namespace PGPHPLIB\Database;

use PDO;

abstract class Connection
{
    protected array $settings = [];
    
    public function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    abstract public function open():PDO;
}
