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

$queryType = new ObjectType([
    "name" => "Query",
    "fields" => [
        "courses" => [
            "type" => Type::listOf($courseType),
            "args" => [],
            "resolve" => function ($rootValue, $args, $context) {
                $courses = (new GraphQL($context["db"]))->getAllCourses();
                return $courses;
            }
        ],
        "course" => [
            "type" => Type::nonNull($courseType),
            "args" => [
                "id" => [
                    "type" => Type::nonNull(Type::id())
                ]
            ],
            "resolve" => function ($rootValue, $args, $context) {
                $course = (new GraphQL($context["db"]))->getCourseById($args["id"]);
                return [
                    "id" => $course["id"],
                    "title" => $course["title"],
                    "description" => $course["description"],
                    "language" => $course["language"]
                ];
            }
        ],
        "exercises" => [
            "type" => Type::nonNull(Type::listOf($exerciseType)),
            "args" => [
                "courseId" => [
                    "type" => Type::nonNull(Type::id())
                ]
            ],
            "resolve" => function ($rootValue, $args, $context) {
                $exercises = (new GraphQL($context["db"]))->getAllExercises($args["courseId"]);
                return $exercises;
            }
        ],
        "exercise" => [
            "type" => $exerciseType,
            "args" => [
                "id" => [
                    "type" => Type::nonNull(Type::id())
                ]
            ],
            "resolve" => function ($rootValue, $args, $context) {
                $exercise = (new GraphQL($context["db"]))->getExercise($args["id"]);
                return [
                    "id" => $exercise["id"],
                    "course_id" => $exercise["course_id"],
                    "question" => $exercise["question"],
                    "answer" => $exercise["answer"]
                ];
            }
        ],
        "assessments" => [
            "type" => Type::nonNull(Type::listOf($assessmentType)),
            "args" => [],
            "resolve" => function ($rootValue, $args, $context) {
                $assessments = (new GraphQL($context["db"]))->getAssessments();
                return $assessments;
            }
        ],
        "assessment" => [
            "type" => $assessmentType,
            "args" => [
                "id" => [
                    "type" => Type::nonNull(Type::id())
                ]
            ],
            "resolve" => function ($rootValue, $args, $context) {
                $assessment = (new GraphQL($context["db"]))->getAssessmentById($args["id"]);
                return [
                    "id" => $assessment["id"],
                    "user_id" => $assessment["user_id"],
                    "course_id" => $assessment["course_id"],
                    "score" => $assessment["score"]
                ];
            }
        ]
    ]
]);


return [
    "query" => $queryType
];
