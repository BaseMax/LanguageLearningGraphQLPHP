<?php

namespace App\Config;

class Config
{
    public static function env(): array
    {
        return [
            "db_name"     => $_ENV["DB_NAME"],
            "db_password" => $_ENV["DB_PASSWORD"] ?? "",
            "db_user"     => $_ENV["DB_USER"],
            "db_host"     => $_ENV["DB_HOST"]
        ];
    }

    public static function getDbName(): string
    {
        return self::env()["db_name"];
    }

    public static function getDbPassword(): string
    {
        return self::env()["db_password"] ?? "";
    }

    public static function getDbUser(): string
    {
        return self::env()["db_user"];
    }

    public static function getDbHost(): string
    {
        return self::env()["db_host"];
    }

    public static function secret(): string
    {
        return $_ENV["SECRET"] ?? "language_learning";
    }
}
