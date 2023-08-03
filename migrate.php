<?php

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// tables: users, courses, exercises, assessments, course_user

$users_table_sql = "CREATE TABLE IF NOT EXISTS users(
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255)
)";

$courses_table_sql = "CREATE TABLE IF NOT EXISTS courses (
    id VARCHAR(255) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    language VARCHAR(255) NOT NULL
)";

$exercises_table_sql = "CREATE TABLE IF NOT EXISTS exercises (
    id VARCHAR(255) PRIMARY KEY,
    course_id VARCHAR(255) NOT NULL,
    question VARCHAR(255) NOT NULL,
    answer VARCHAR(255) NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
)";

$assessment_table_sql = "CREATE TABLE IF NOT EXISTS assessment (
    id VARCHAR(255) PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL,
    course_id VARCHAR(255) NOT NULL,
    score INT DEFAULT 0
)";

$dbname = $_ENV["DB_NAME"];
$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USER"];
$password = $_ENV["DB_PASSWORD"];

$db = new PDO(
    "mysql:dbname=$dbname;host=$host",
    $user,
    $password
);

($db->prepare($users_table_sql))->execute();
($db->prepare($courses_table_sql))->execute();
($db->prepare($exercises_table_sql))->execute();
