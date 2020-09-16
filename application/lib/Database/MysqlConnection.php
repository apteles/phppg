<?php
namespace PGPHPLIB\Database;

use Exception;
use PDO;

class MysqlConnection extends Connection
{
    public function open():PDO
    {
        try {
            return new PDO("mysql:dbname={$this->settings['name']};host={$this->settings['host']};port={$this->settings['host']}", $this->settings['user'], $this->settings['pass']);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode());
        }
    }
}
