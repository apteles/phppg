<?php
namespace PGPHPLIB\Database;

use Exception;
use PDO;

class PGConnection extends Connection
{
    public function open():PDO
    {
        try {
            return new PDO("pgsql:dbname={$this->settings['name']};user={$this->settings['user']};password={$this->settings['pass']};host={$this->settings['host']};port={$this->settings['port']}");
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode());
        }
    }
}
