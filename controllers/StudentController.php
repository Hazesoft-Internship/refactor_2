<?php

namespace Controllers;

require_once './classes/Database.php';
require_once './classes/models/Student.php';

use classes\Database;
use Models\Student;
use Models\UndergraduateStudent;
use Models\GraduateStudent;
use Models\PhDStudent;

class StudentController
{
    private $students = [];
    private $courses = [];
    private static $totalGradesAssigned = 0;

    public function __construct()
    {
        $this->loadData();
    }

    private function loadData(): void
    {
        $this->courses = Database::getCourses();
        foreach (Database::getStudents() as $studentData) {
            
            switch ($studentData['type']) {
                case 'undergraduate':
                    $student = new UndergraduateStudent(
                        id: $studentData['id'],
                        name: $studentData['name'],
                        type: $studentData['type']
                    );
                    break;
                case 'graduate':
                    $student = new GraduateStudent(
                        id: $studentData['id'],
                        name: $studentData['name'],
                        type: $studentData['type']
                    );
                    break;
                case 'phd':
                    $student = new PhDStudent(
                        id: $studentData['id'],
                        name: $studentData['name'],
                        type: $studentData['type']
                    );
                    break;
                default:
                    throw new \InvalidArgumentException("Unknown student type: " . $studentData['type']);
            }
            $this->students[$studentData['id']] = $student;
        }
    }

    public function addGrade($studentId, $courseCode, $score): bool
    {
        if (!isset($this->students[$studentId])) {
            echo "Error: Student not found.<br>";
            return false;
        }

        if ($score < 0 || $score > 100) {
            echo "Error: Score must be between 0 and 100.<br>";
            return false;
        }

        $courseExists = \array_filter(array: $this->courses, callback: fn($course): bool => $course['code'] === $courseCode);
        if (!$courseExists) {
            echo "Error: Course not found.<br>";
            return false;
        }

        $this->students[$studentId]->addCourse(courseCode: $courseCode, score: $score);
        self::$totalGradesAssigned++;
        return true;
    }

    public function displayStudentReport($studentId): void
    {
        if (!isset($this->students[$studentId])) {
            echo "Error: Student not found.<br>";
            return;
        }

        $student = $this->students[$studentId];
        $gpa = $student->calculateGPA(courses: $this->courses);

        include 'classes/views/student_report.php';
    }

    public function getSystemStatistics(): void
    {
        include 'classes/views/system_statistics.php';
    }

    public function runDemo(): void
    {
        $this->addGrade(studentId: 1, courseCode: 'CS101', score: 85);
        $this->addGrade(studentId: 1, courseCode: 'MATH101', score: 92);
        $this->addGrade(studentId: 2, courseCode: 'CS201', score: 78);
        $this->addGrade(studentId: 3, courseCode: 'ENG101', score: 65);
        $this->addGrade(studentId: 3, courseCode: 'CS101', score: 72);
        $this->addGrade(studentId: 4, courseCode: 'CS201', score: 95);

        $this->displayStudentReport(studentId: 1);
        $this->displayStudentReport(studentId: 2);
        $this->displayStudentReport(studentId: 3);
        $this->displayStudentReport(studentId: 4);

        $this->getSystemStatistics();
    }
}
