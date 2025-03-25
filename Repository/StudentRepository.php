<?php

namespace Repository;

require_once 'Class/Student.php';
require_once 'Class/Course.php';
require_once 'Class/Grade.php';

use Class\Student;
use Class\Course;
use Class\Grade;
use Exception;

class StudentRepository
{
    public $students = [];

    public function __construct()
    {
        $this->students = [
            new class(1, 'John Doe', 'Undergraduate') extends Student {
                public function __construct($id, $name, $type)
                {
                    parent::__construct($id, $name, $type);
                }
            },
            new class(2, 'Jane Smith', 'Graduate') extends Student {
                public function __construct($id, $name, $type)
                {
                    parent::__construct($id, $name, $type);
                }
            },
            new class(3, 'Mike Johnson', 'Undergraduate') extends Student {
                public function __construct($id, $name, $type)
                {
                    parent::__construct($id, $name, $type);
                }
            },
            new class(4, 'Sarah Williams', 'PHD') extends Student {
                public function __construct($id, $name, $type)
                {
                    parent::__construct($id, $name, $type);
                }
            }
        ];
    }
}

class CourseRepository
{
    public $courses = [];

    public function __construct()
    {
        $this->courses = [
            new class('CS101', 'Introduction to Programming', 3) extends Course {
                public function __construct($code, $name, $credits)
                {
                    parent::__construct($code, $name, $credits);
                }
            },
            new class('CS201', 'Data Structures', 4) extends Course {
                public function __construct($code, $name, $credits)
                {
                    parent::__construct($code, $name, $credits);
                }
            },
            new class('MATH101', 'Calculus I', 3) extends Course {
                public function __construct($code, $name, $credits)
                {
                    parent::__construct($code, $name, $credits);
                }
            },
            new class('ENG101', 'English Composition', 2) extends Course {
                public function __construct($code, $name, $credits)
                {
                    parent::__construct($code, $name, $credits);
                }
            }
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
