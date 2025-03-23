<?php

namespace App\Views;

class GetSystemStatistics {
    // Function to get statistics about the system
    public function getSystemStatistics()
    {
        global $students, $totalGradesAssigned, $totalStudentsProcessed;

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