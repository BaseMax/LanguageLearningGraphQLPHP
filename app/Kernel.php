<?php

namespace App;

use App\Database\Database;
use App\Config\Config;

use PDO;

class Kernel
{
    private PDO $db;
    private array $config;
    public function __construct()
    {
        $this->db = Database::getDB();
        $this->config = Config::env();
    }
}
