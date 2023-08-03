<?php

namespace App\Request;

class Request
{
    public static function data(): array
    {
        $rawData = file_get_contents("php://input");
        return json_decode($rawData, true);
    }

    public static function method(): string
    {
        return $_SERVER["REQUEST_METHOD"];
    }
}
