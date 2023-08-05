<?php

namespace App\GraphQL;

use PDO;

class GraphQL
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCourses(): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM courses;"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseById(string $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM courses WHERE id = ?"
        );
        $stmt->execute([
            $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllExercises(string $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM exercises WHERE course_id = ?;"
        );
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExercise(string $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM exercises WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAssessments(): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM assessments;"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssessmentById(string $id): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM assessments WHERE id = ?;"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function enroll(string $course_id, string $user_id): array
    {
        $id = uniqid();
        $stmt = $this->db->prepare(
            "INSERT INTO `assessments` (id, course_id, user_id) VALUES (?, ?, ?);"
        );
        $stmt->execute([
            $id,
            $course_id,
            $user_id
        ]);
        return $this->getAssessmentById($id);
    }

    public function submitExercise(string $exercise_id, string $answer): bool
    {
        $exercise = $this->getExercise($exercise_id);
        if ($exercise["answer"] == $answer)
            return true;
        return false;
    }
}
