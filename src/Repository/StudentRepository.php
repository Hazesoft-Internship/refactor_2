<?php

namespace Weave\Refactor2\Repository;

use Weave\Refactor2\Class\Students\Undergraduate;
use Weave\Refactor2\Class\Students\Graduate;
use Weave\Refactor2\Class\Students\PHD;
use Weave\Refactor2\Repository\CourseRepository;
use Weave\Refactor2\Repository\GradeRepository;

class StudentRepository
{
    public static $students = [];
    public static $courses = [];
    public static $grades = [];

    public static int $totalStudents = 0;
    public static int $studentsWithCourses = 0;
    public static int $totalCourseEnrollments = 0;
    public static int $totalGradesAssigned = 0;
    public static int $totalStudentsProcessed = 0;

    public static function initialize()
    {
        self::$students = [
            new Undergraduate(1, 'John Doe', 'Undergraduate'),
            new Graduate(2, 'Jane Smith', 'Graduate'),
            new Undergraduate(3, 'Mike Johnson', 'Undergraduate'),
            new PHD(4, 'Sarah Williams', 'PHD')
        ];
        self::$totalStudents = count(self::$students);

        CourseRepository::initialize();
        GradeRepository::initialize();
        self::$courses = CourseRepository::$courses;
        self::$grades = GradeRepository::$grades;

        foreach (self::$grades as $grade) {
            [$studentId, $courseCode, $score] = $grade;
            $student = array_filter(self::$students, fn($s) => $s->id === $studentId);
            if (!$student) continue;
            $student = array_values($student)[0];

            $course = array_filter(self::$courses, fn($c) => $c->code === $courseCode);
            if (!$course) continue;
            $course = array_values($course)[0];

            $gradeLetter = match (true) {
                $score >= 90 => 'A',
                $score >= 80 => 'B',
                $score >= 70 => 'C',
                $score >= 60 => 'D',
                default => 'F',
            };

            $student->addCourse($course, $score, $gradeLetter);
            $student->calculateGPA();

            self::$totalCourseEnrollments = self::$totalCourseEnrollments + 1;
            self::$totalGradesAssigned = self::$totalGradesAssigned + 1;

            if (count($student->courses) === 1) {
                self::$studentsWithCourses = self::$studentsWithCourses + 1;
            }
        }

        self::$totalStudentsProcessed = self::$studentsWithCourses;
    }

    public static function getTotalStudents()
    {
        return self::$totalStudents;
    }
    public static function getStudentsWithCourses()
    {
        return self::$studentsWithCourses;
    }
    public static function getTotalCourseEnrollments()
    {
        return self::$totalCourseEnrollments;
    }
    public static function getTotalGradesAssigned()
    {
        return self::$totalGradesAssigned;
    }
    public static function getTotalStudentsProcessed()
    {
        return self::$totalStudentsProcessed;
    }
}
