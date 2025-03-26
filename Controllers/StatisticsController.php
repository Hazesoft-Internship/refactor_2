<?php

namespace Refactor2\Controllers;

require_once(__DIR__ . '/../ArrayDB.php');

use Refactor2\ArrayDB;

class Statistics extends ArrayDB
{
    public function getSystemStatistics()
    {
        $students = self::$students;
        $totalGradesAssigned = self::$totalGradesAssigned;
        $totalStudentsProcessed = self::$totalStudentsProcessed;

        $totalStudents = count($students);
        $studentsWithCourses = 0;
        $totalCourseEnrollments = 0;

        foreach ($students as $student) {
            if (!empty($student['courses'])) {
                $studentsWithCourses++;
                $totalCourseEnrollments += count($student['courses']);
            }
        }

        echo "<br>====== System Statistics ======<br>";
        echo "Total Students: {$totalStudents}<br>";
        echo "Students with Courses: {$studentsWithCourses}<br>";
        echo "Total Course Enrollments: {$totalCourseEnrollments}<br>";
        echo "Total Grades Assigned: {$totalGradesAssigned}<br>";
        echo "Total Students Processed: {$totalStudentsProcessed}<br>";
        echo "==============================<br>";
    }
}
