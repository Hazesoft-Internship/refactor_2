<?php

namespace Controls;

use Repository\CourseRepository;
use Repository\StudentRepository;
use View\StudentView;

require_once '../repository/CourseRepository.php';
require_once '../repository/StudentRepository.php';
require_once '../view/StudentView.php';

class StudentController
{
    private StudentRepository $studentRepo;
    private CourseRepository $courseRepo;
    private $totalGradesAssigned = 0;
    private $totalStudentsProcessed = 0;

    public function __construct(StudentRepository $studentRepo, CourseRepository $courseRepo) 
    {
        $this->studentRepo = $studentRepo;
        $this->courseRepo  = $courseRepo;
    }

    public function addGrade($studentId, $courseCode, $score): void
    {
        $student = $this->studentRepo->getStudentById($studentId);
        if ($student === null) {
            echo "Error: Student not found.<br>";
            return;
        }

        $course = $this->courseRepo->getCourseByCode($courseCode);
        if ($course === null) {
            echo "Error: Course not found.<br>";
            return;
        }

        try {
            $student->addOrUpdateGrade($course, $score);
            echo "Grade added/updated for student {$student->getName()} in course {$course->getCode()}.<br>";
            $this->totalGradesAssigned++;
        } catch (\InvalidArgumentException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    public function displayStudentReport($studentId): void
    {
        $student = $this->studentRepo->getStudentById($studentId);
        if ($student === null) {
            echo "Error: Student not found.<br>";
            return;
        }

        $gpa = $student->calculateGPA();
        $this->totalStudentsProcessed++;

        StudentView::displayStudentReport($student, $gpa);
    }

    public function getSystemStatistics(): void
    {
        $students = $this->studentRepo->getAllStudents();
        $totalStudents = count($students);
        $studentsWithCourses = 0;
        $totalCourseEnrollments = 0;

        foreach ($students as $student) {
            $grades = $student->getGrades();
            if (!empty($grades)) {
                $studentsWithCourses++;
                $totalCourseEnrollments += count($grades);
            }
        }

        StudentView::displaySystemStatistics($totalStudents,
                                    $studentsWithCourses,
                                    $totalCourseEnrollments,
                                    $this->totalGradesAssigned,
                                    $this->totalStudentsProcessed
                                );
    }

    public function runDemo(): void
    {
        // Adding grades
        $this->addGrade(1, 'CS101', 85);
        $this->addGrade(1, 'MATH101', 92);
        $this->addGrade(2, 'CS201', 78);
        $this->addGrade(3, 'ENG101', 65);
        $this->addGrade(3, 'CS101', 72);
        $this->addGrade(4, 'CS201', 95);

        // Display student reports
        $this->displayStudentReport(1);
        $this->displayStudentReport(2);
        $this->displayStudentReport(3);
        $this->displayStudentReport(4);

        // Display system statistics
        $this->getSystemStatistics();
    }
}
?>