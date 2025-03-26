<?php

namespace src\controller;
use src\model\Student;


class DisplayStudentReport
{
    public static function displayStudentReport(Student $student)
    {
        $gpa = $student->calculateGPA($student->id);
        echo "<br>====== Student Report ======<br>";
        echo "ID: {$student->id['id']}<br>";
        echo "Name: {$student->name}<br>";
        echo "Type: {$student->type}<br>";
        echo "GPA: {$gpa}<br>";
        echo "Courses:<br>";

        if (empty(Student::getAllStudents()[$student->id - 1]['courses'])) {
            echo "No courses registered.<br>";
        } else {
            foreach (Student::getAllStudents()[$student->id - 1]['courses'] as $course) {
                echo "- {$course['code']}: Score = {$course['score']}, Grade = {$course['letterGrade']}<br>";
            }
        }

        echo "==========================<br>";
    }
}