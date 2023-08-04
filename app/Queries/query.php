<?php

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

$userType = new ObjectType([
    "name" => "User",
    "fields" => [
        "id" => [
            "type" => Type::id()
        ],
        "name" => [
            "type" => Type::string()
        ],
        "email" => [
            "type" => Type::string()
        ],
        "password" => [
            "type" => Type::string()
        ]
    ]
]);

$courseType = new ObjectType([
    "name" => "Course",
    "fields" => [
        "id" => [
            "type" => Type::id()
        ],
        "title" => [
            "type" => Type::string()
        ],
        "description" => [
            "type" => Type::string()
        ],
        "language" => [
            "type" => Type::string()
        ]
    ]
]);

$exerciseType = new ObjectType([
    "name" => "Exercise",
    "fields" => [
        "id" => [
            "type" => Type::id()
        ],
        "course" => [
            "type" => $courseType
        ],
        "question" => [
            "type" => Type::string()
        ],
        "answer" => [
            "type" => Type::string()
        ]
    ]
]);

$assessmentType = new ObjectType([
    "name" => "Assessment",
    "fields" => [
        "id" => [
            "type" => Type::id()
        ],
        "course" => [
            "type" => $courseType
        ],
        "user" => [
            "type" => $userType
        ],
        "score" => [
            "type" => Type::int()
        ]
    ]
]);