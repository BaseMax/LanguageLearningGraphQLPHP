<?php

namespace App\Database;

use App\Config\Config;
use PDO;

class Database
{
    private static PDO $db;

    public static function getDB(): PDO
    {
        if (isset(self::$db))
            return self::$db;

        $config = Config::env();
        self::$db = new PDO(
            "mysql:dbname={$config['db_name']};host={$config['db_host']}",
            $config["db_user"],
            $config["db_password"]
        );
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$db;
    }
}
