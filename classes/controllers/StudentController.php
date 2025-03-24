<?php
namespace Controllers;

require_once './classes/Database.php';
require_once './classes/models/Student.php';

use classes\Database;
use Models\Student;

class StudentController {
    private $students = [];
    private $courses = [];
    private $totalGradesAssigned = 0;

    public function __construct() {
        $this->loadData();
    }

    private function loadData() {
        $this->courses = Database::getCourses();
        foreach (Database::getStudents() as $studentData) {
            $this->students[$studentData['id']] = new Student($studentData['id'], $studentData['name'], $studentData['type']);
        }
    }

    public function addGrade($studentId, $courseCode, $score) {
        if (!isset($this->students[$studentId])) {
            echo "Error: Student not found.<br>";
            return false;
        }

        if ($score < 0 || $score > 100) {
            echo "Error: Score must be between 0 and 100.<br>";
            return false;
        }

        $courseExists = array_filter($this->courses, fn($course) => $course['code'] === $courseCode);
        if (!$courseExists) {
            echo "Error: Course not found.<br>";
            return false;
        }

        $this->students[$studentId]->addCourse($courseCode, $score);
        $this->totalGradesAssigned++;
        return true;
    }

    public function displayStudentReport($studentId) {
        if (!isset($this->students[$studentId])) {
            echo "Error: Student not found.<br>";
            return;
        }

        $student = $this->students[$studentId];
        $gpa = $student->calculateGPA($this->courses);

        include 'classes/views/student_report.php';
    }

    public function getSystemStatistics() {
        include 'classes/views/system_statistics.php';
    }

    public function runDemo() {
        $this->addGrade(1, 'CS101', 85);
        $this->addGrade(1, 'MATH101', 92);
        $this->addGrade(2, 'CS201', 78);
        $this->addGrade(3, 'ENG101', 65);
        $this->addGrade(3, 'CS101', 72);
        $this->addGrade(4, 'CS201', 95);

        $this->displayStudentReport(1);
        $this->displayStudentReport(2);
        $this->displayStudentReport(3);
        $this->displayStudentReport(4);

        $this->getSystemStatistics();
    }
}
