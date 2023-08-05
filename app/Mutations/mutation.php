<?php

use App\GraphQL\GraphQL;
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

$mutationType = new ObjectType([
    "name" => "Mutation",
    "fields" => [
        "enroll" => [
            "type" => $courseType,
            "args" => [
                "courseId" => [
                    "type" => Type::nonNull(Type::id())
                ]
            ],
            "resolve" => function ($rootValue, $args, $context) {
                $assessment = (new GraphQL($context["db"]))->enroll($args["course_id"], $args["user_id"]);
                return [
                    "id" => $assessment["id"],
                    "course_id" => $assessment["course_id"],
                    "user_id" => $assessment["user_id"]
                ];
            }
        ],
        "submitExercise" => [
            "type" => $assessmentType,
            "args" => [
                "exerciseId" => [
                    "type" => Type::nonNull(Type::id())
                ],
                "answer" => [
                    "type" => Type::nonNull(Type::string())
                ]
            ],
            "resolve" => function ($rootValue, $args, $context) {
            }
        ]
    ]
]);


return [
    "mutation" => $mutationType
];
