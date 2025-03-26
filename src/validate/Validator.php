<?php

namespace src\validate;

require_once(__DIR__ . "/../model/Student.php");
require_once(__DIR__ . "/../model/Course.php");

use Exception;
use src\model\Course;
use src\model\Student;

class Validator
{
    public function studentExist(int $studentId)
    {
        $students = Student::getAllStudents();
        $studentIndex = -1;
        foreach ($students as $index => $student) {
            if ($student["id"] === $studentId) {
                $studentIndex = $studentId;
                break;
            }
        }
        if ($studentIndex === -1) {
            throw new Exception("student not found");
        } else {
            return true;
        }
    }

    public function isScoreValid(int $score):bool
    {
        if ($score < 0 || $score > 100) {
            throw new Exception("not valid score");
        } else {
            return true;
        }
    }
    public function isCourseAvailable(string $courseCode):bool
    {
        $courseFound = false;
        $courses = Course::getCourses();

        foreach ($courses as $index => $course) {
            if ($course["code"] === $courseCode) {
                $courseFound = true;
                break;
            }
        }
        if (!$courseFound) {
            throw new Exception("course not found");
        } else {
            return true;
        }
    }
}
