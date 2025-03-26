<?php

namespace Repository;

use Model\Student;

require_once '../model/Student.php';

class StudentRepository
{
    private array $students = [];

    public function addStudent(Student $student): void
    {
        $this->students[$student->getId()] = $student;
    }

    public function getStudentById($id): ?Student
    {
        return $this->students[$id] ?? null;
    }

    public function getAllStudents(): array
    {
        return $this->students;
    }
}
?>