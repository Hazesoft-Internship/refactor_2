<?php
require_once 'Class/Student.php';
require_once 'Class/Course.php';
require_once 'Class/Grade.php';

class StudentRepository
{
    public $students = [];
    public function __construct()
    {
        $this->students = [
            new Student(1, 'John Doe', 'Undergraduate'),
            new Student(2, 'Jane Smith', 'Graduate'),
            new Student(3, 'Mike Johnson', 'Undergraduate'),
            new Student(4, 'Sarah Williams', 'PHD')
        ];
    }
}

class CourseRepository
{
    public $courses = [];
    public function __construct()
    {
        $this->courses = [
            new Course('CS101', 'Introduction to Programming', 3),
            new Course('CS201', 'Data Structures', 4),
            new Course('MATH101', 'Calculus I', 3),
            new Course('ENG101', 'English Composition', 2)
        ];
    }
}

function seedData($studentRepo, $courseRepo)
{
    $grades = [
        [1, 'CS101', 85],
        [1, 'MATH101', 92],
        [2, 'CS201', 78],
        [3, 'ENG101', 65],
        [3, 'CS101', 72],
        [4, 'CS201', 95]
    ];
    foreach ($grades as [$studentId, $courseCode, $score]) {
        $student = current(array_filter($studentRepo->students, fn($s) => $s->id === $studentId)); // Find student by ID
        $course = current(array_filter($courseRepo->courses, fn($c) => $c->code === $courseCode)); // Find course by code

        // Validate student and course data
        if (!$student || !$course) {
            throw new Exception("Invalid student or course data for student ID: $studentId and course code: $courseCode");
        }

        // Calculate grade and GPA
        $grade = Grade::getLetterGrade($score, $student->type);
        $student->addCourse($course, $score, $grade);
        $student->calculateGPA();
    }
}
